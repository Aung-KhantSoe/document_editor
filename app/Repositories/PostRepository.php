<?php
    
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create($attributes){
        return DB::transaction(function () use ($attributes) {
            $post = Post::query()->create([
                'title' => data_get($attributes,'title','Untitled'),
                'body' => data_get($attributes,'body')
            ]);
            
            if ($user_ids = data_get($attributes,'user_ids')) {# code...
                $post->users()->sync($user_ids);
            }
            return $post;
        });
    }
    public function update($post,$attributes){
        return DB::transaction(function () use ($post,$attributes){
            $updated =  $post->update([
                'title' => data_get($attributes,'title',$post->title),
                'body' => data_get($attributes,'body',$post->body),
            ]);
            if(!$updated){
                throw new \Exception("Failed to update post", 1);
                
            }
            if ($user_ids = data_get($attributes,'user_ids')) {# code...
                $post->users()->sync($user_ids);
            }
            return $post;
        });
        
    }
    public function forceDelete($post){
        return DB::transaction(function () use ($post) {
            $deleted = $post->forceDelete();
            if(!$deleted){
                throw new \Exception("Failed to delete post", 1); 
            }
            return $deleted;
        });

    }
}

?>