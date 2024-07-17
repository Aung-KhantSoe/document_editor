<?php
    
namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralJsonException;

class CommentRepository extends BaseRepository
{
    public function create($attributes){
        return DB::transaction(function () use ($attributes) {
            $comment = Comment::query()->create([
                'body' => data_get($attributes,'body'),
                'user_id' => data_get($attributes,'user_id'),
                'post_id' => data_get($attributes,'post_id'),
            ]);
            
            return $comment;
        });
    }
    public function update($comment,$attributes){
        return DB::transaction(function () use ($comment,$attributes){
            $updated =  $comment->update([
                'body' => data_get($attributes,'body',$comment->body),
                'user_id' => data_get($attributes,'user_id',$comment->user_id),
                'post_id' => data_get($attributes,'post_id',$comment->post_id),
            ]);
           throw_if(!$updated,GeneralJsonException::class,'Failed to update comment');    
            return $comment;
        });
        
    }
    public function forceDelete($comment){
        return DB::transaction(function () use ($comment) {
            $deleted = $comment->forceDelete();
            throw_if(!$deleted,GeneralJsonException::class,'Failed to delete comment');
            return $deleted;
        });

    }
}

?>