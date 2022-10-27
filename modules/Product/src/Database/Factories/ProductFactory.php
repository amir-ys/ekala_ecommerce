<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'user_id' => User::factory(),
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(5000, 50000000),
//            'special_price' => $this->faker->numberBetween(5000, 50000000),
//            'special_price_start' =>  (new Jalalian(1396 , 3 ,5 , 12 ,06))->format('Y/m/d H:i') ,
//            'special_price_end' => (new Jalalian(1399 , 3 ,5 , 07 ,30))->format('Y/m/d H:i'),
            'is_active' => $this->faker->randomElement([ProductStatus::INACTIVE->value, ProductStatus::ACTIVE->value]),
            'is_marketable' => $this->faker->randomElement(Product::$morketableStatuses),
        ];
    }
}
