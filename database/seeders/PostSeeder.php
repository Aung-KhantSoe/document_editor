<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Factories\Helpers\FactoryHelper;
use Database\Seeders\Traits\DisableEnableForeignChecks;

class PostSeeder extends Seeder
{
    use TruncateTable,DisableEnableForeignChecks;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableforeignchecks();
        $this->truncatetable('posts');
        $posts = Post::factory(3)
            ->has(Comment::factory(3),'comments')
            ->untitled()->create();
        $posts->each(function(Post $post){
            $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]);
        });

        $this->enableforeignchecks();
    }
}
