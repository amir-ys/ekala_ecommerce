<?php

namespace Modules\Brand\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Brand\Enums\BrandStatus;
use Modules\Brand\Models\Brand;


class BrandFactory extends Factory
{
    protected $model = Brand::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' =>  $this->faker->word ,
            'is_active' => $this->faker->randomElement([BrandStatus::ACTIVE->value , BrandStatus::INACTIVE->value]) ,
        ];
    }
}
