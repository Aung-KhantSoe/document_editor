<?php
    
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralJsonException;

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
            throw_if(!$updated,GeneralJsonException::class,'Failed to update post');
            if ($user_ids = data_get($attributes,'user_ids')) {# code...
                $post->users()->sync($user_ids);
            }
            return $post;
        });
        
    }
    public function forceDelete($post){
        return DB::transaction(function () use ($post) {
            $deleted = $post->forceDelete();
            throw_if(!$deleted,GeneralJsonException::class,'Failed to delete');
            return $deleted;
        });

    }
}

?>