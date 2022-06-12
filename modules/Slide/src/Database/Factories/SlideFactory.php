<?php

namespace Modules\Slide\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Slide\Models\Slide;

/**
 * @extends Factory
 */
class SlideFactory extends Factory
{
    protected $model = Slide::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'priority' => random_int(1, 10),
            'status' => $this->faker->randomElement([1, 0, 2, 3]),
            'type' => $this->faker->randomElement(['sliders', 'top-left-banner', 'bottom-middle-banner']),
            'link' => $this->faker->url,
            'btn_text' => $this->faker->text,
            'photo' => $this->faker->imageUrl,
        ];
    }
}
