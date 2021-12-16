<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        
        $x = $this->faker->randomElement([600, 400]);
        $y = $this->faker->randomElement([600, 400]);
        $url = "https://picsum.photos/id/".$this->faker->numberBetween(0,1000)."/".$x."/".$y.".jpg";
        $type = $this->faker->randomElement(['App\Models\User', 'App\Models\Post']);

        return [
            'imageable_id' => $type === 'App\Models\User' ? $this->faker->numberBetween(1,5) : $this->faker->numberBetween(1,25),
            'imageable_type' => $type,
            'image_url' => $url,
        ];
    }
}
