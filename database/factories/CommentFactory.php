<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'video_id' => Video::first() ?? Video::factory(),
            'body' => $this->faker->realText()
        ];
    }
}
