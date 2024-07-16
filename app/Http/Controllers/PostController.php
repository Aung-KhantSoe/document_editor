<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostResource
     */
    public function index(Request $request)
    {
        //
        $page_size = $request->page_size??20;
        $posts = Post::query()->paginate($page_size);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return PostResource
     */
    public function store(Request $request)
    {
        //
        $post = DB::transaction(function () use ($request) {
            $post = Post::query()->create([
                'title' => $request->title,
                'body' => $request->body
            ]);
    
            $post->users()->sync($request->user_ids);
            return $post;
        });
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        //
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function update(Request $request, Post $post)
    {
        //
        $updated = $post->update([
            'title' => $request->title??$post->title,
            'body' => $request->body??$post->body,
        ]);
        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model'
                ]
                ],400);
        }
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function destroy(Post $post)
    {
        //
        $deleted = $post->forceDelete();
        if(!$deleted){
            return new JsonResponse([
                'errors' => [
                    'Failed to delete model'
                ]
                ],400);
        }
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
