<?php

namespace Modules\Slide\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Slide\Enums\SlideStatus;
use Modules\Slide\Enums\SlideType;
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
            'status' => $this->faker->randomElement([SlideStatus::ACTIVE->value , SlideStatus::INACTIVE->value]),
            'type' => $this->faker->randomElement([SlideType::SLIDER->value , SlideType::BANNER_BOTTOM->value , SlideType::BANNER_TOP_LEFT->value]),
            'link' => $this->faker->url,
            'btn_text' => $this->faker->text,
            'photo' => $this->faker->imageUrl,
        ];
    }
}
