<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CommentResource
     */
    public function index(Request $request)
    {
        //
        $page_size = $request->page_size??20;
        $comments = Comment::query()->paginate($page_size);
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return CommentResource
     */
    public function store(Request $request,CommentRepository $commentRepository)
    {
        //
        $comment = $commentRepository->create($request->only([
            'body','user_id','post_id'
        ]));
        return new CommentResource($comment);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        //
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return CommentResource
     */
    public function update(Request $request, Comment $comment,CommentRepository $commentRepository)
    {
        //
        $updated = $commentRepository->update($comment,$request->only([
            'body','user_id','post_id'
        ]));
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return CommentResource
     */
    public function destroy(Comment $comment,CommentRepository $commentRepository)
    {
        //
        $deleted = $commentRepository->forceDelete($comment);
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
