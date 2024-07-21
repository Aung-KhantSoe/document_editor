<?php

namespace Tests\Unit;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create()
    {
        //1.goal
        //test if create will actually create a record in db
        //2.env
        $repository = $this->app->make(PostRepository::class);
        //3.payload
        $payload = [
            'title' => 'test title hello',
            'body'  => []
        ];
        //4.compare
        $result = $repository->create($payload);

        $this->assertSame($payload['title'], $result->title, 'Post created does not have the same title.');
    }
    public function test_update()
    {
        //1.goal
        //test if update will actually update a record in db
        //2.env
        $repository = $this->app->make(PostRepository::class);
        $post = Post::factory(1)->create()->first();
        //3.payload
        $payload = ['title' => 'hello'];
        //4.compare
        $result = $repository->update($post, $payload);
        $this->assertSame($payload['title'], $post->title, 'Post created does not have the same title.');
    }
    public function test_forceDelete()
    {
        //1.goal
        //test if update will actually update a record in db
        //2.env
        $repository = $this->app->make(PostRepository::class);
        $post = Post::factory(1)->create()->first();
        //3.payload
        //don't need here
        //4.compare
        $deleted = $repository->forceDelete($post);
        $found = Post::query()->find($post->id);
        $this->assertSame(null,$found,'Post is not deleted');
    }

    public function test_delete_will_throw_exception_when_delete_post_that_doesnt_exist(){
        $repository = $this->app->make(PostRepository::class);
        $post = Post::factory(1)->make()->first();

        $this->expectException(GeneralJsonException::class);
        $deleted = $repository->forceDelete($post);
    }
}
