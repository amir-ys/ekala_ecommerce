<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;
use Modules\Product\Models\ProductWarranty;

/**
 * @extends Factory
 */
class ProductWarrantyFactory extends Factory
{
    protected $model = ProductWarranty::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'product_id' => Product::factory(),
            'price_increase' => $this->faker->numberBetween(-4000, 5000),
        ];
    }
}
