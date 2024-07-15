<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Helpers\FactoryHelper;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postId = FactoryHelper::getRandomModelId(Post::class);
        $userId = FactoryHelper::getRandomModelId(User::class);
        return [
            'body' => [],
            'user_id' => $userId,
            'post_id' => $postId,
        ];
    }
}
