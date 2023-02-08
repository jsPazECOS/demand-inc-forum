<?php

namespace Database\Factories;

use App\Models\Post\Post;
use App\Models\Post\PostResponse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\User>
 */
class PostResponseFactory extends Factory
{
    protected $model = PostResponse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'response' => fake()->realText(500),
            'image' => fake()->imageUrl(300, 300)
        ];
    }

}
