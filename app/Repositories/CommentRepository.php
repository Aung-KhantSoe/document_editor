<?php
    
namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

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
            if(!$updated){
                throw new \Exception("Failed to update comment", 1);
                
            }
            
            return $comment;
        });
        
    }
    public function forceDelete($comment){
        return DB::transaction(function () use ($comment) {
            $deleted = $comment->forceDelete();
            if(!$deleted){
                throw new \Exception("Failed to delete comment", 1); 
            }
            return $deleted;
        });

    }
}

?>