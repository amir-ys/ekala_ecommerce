<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;

/**
 * @extends Factory
 */
class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'images' =>  $this->faker->imageUrl,
            'product_id' => Product::factory(),
            'is_primary' => $this->faker->randomElement([1, 0])
        ];
    }
}
