<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'isEdited'  => $this->faker->boolean(),
            'img_url'  => $this->faker->imageUrl(20,20,'faces'),
            'img_alt_text' => $this->faker->sentence(),
            'p_content'  => $this->faker->paragraph(5),
            // 'user_id'  => $this->faker->numberBetween(1,5),
            'user_id'  => User::factory(),
            'language_id'  => Language::get()->random()->id,
        ];
    }
}
