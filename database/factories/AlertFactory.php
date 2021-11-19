<?php

namespace Database\Factories;

use App\Models\Alert;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'isRead'  => $this->faker->boolean(),
            'a_content'  => $this->faker->paragraph(2),
            #Fkeys
            'post_id'  => Post::get()->random()->id,
            'user_id'  => User::get()->random()->id,
        ];
    }
}
