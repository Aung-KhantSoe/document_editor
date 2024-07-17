<?php

namespace App\Http\Controllers;

use App\Events\Post\PostCreatedEvent;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

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
        event(new PostCreatedEvent(Post::factory()->make()));
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
    public function store(Request $request,PostRepository $postRepository)
    {
        //
        $post = $postRepository->create($request->only([
            'title','body','user_ids'
        ]));
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
    public function update(Request $request, Post $post,PostRepository $postRepository)
    {
        //
        $post = $postRepository->update($post,$request->only([
            'title','body','user_ids'
        ]));
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function destroy(Post $post,PostRepository $postRepository)
    {
        //
        $deleted = $postRepository->forceDelete($post);
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
