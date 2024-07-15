<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            'title'     => $title,
            'slug'      => Str::slug($title),
            'body'      => $this->faker->paragraph(),
            'author_id' => $attribute['author_id'] ?? User::factory()
        ];
    }
}
