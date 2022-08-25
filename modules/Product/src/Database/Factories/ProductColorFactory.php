<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;

/**
 * @extends Factory
 */
class ProductColorFactory extends Factory
{
    protected $model = ProductColor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'color_name' => $this->faker->colorName,
            'color_value' => $this->faker->hexColor(),
            'price_increase' => $this->faker->numberBetween(-4000, 5000),
            'product_id' => Product::factory(),
        ];
    }
}
