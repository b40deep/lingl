<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
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
            'isEdited'  => $this->faker->boolean(),
            'c_content'  => $this->faker->paragraph(),
            #Fkeys
            'post_id'  => Post::get()->random()->id,
            'user_id'  => User::factory(),
            // 'user_id'  => $this->faker->numberBetween(1,5),
        ];
    }
}
