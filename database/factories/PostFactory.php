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
        $x = $this->faker->randomElement([600, 400]);
        $y = $this->faker->randomElement([600, 400]);
        $link = $this->faker->imageUrl($x, $y, null, false, 'soli deo gloria', false);
        $url = $this->faker->randomElement([$link, null]);
        
        return [
            'is_edited'  => $this->faker->boolean(),
            'img_url'  => $url,
            'img_alt_text' => $url==null ? null : $this->faker->realText($maxNbChars = 40),
            'content'  => $this->faker->realText($maxNbChars = 200),
            // 'user_id'  => $this->faker->numberBetween(1,5),
            // 'user_id'  => User::factory(),
            'user_id'  => User::get()->random()->id,
            'language_id'  => Language::get()->random()->id,
        ];
    }
}
