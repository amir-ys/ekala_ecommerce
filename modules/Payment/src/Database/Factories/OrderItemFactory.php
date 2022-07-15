<?php

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\OrderItem;
use Modules\Product\Models\Product;

/**
 * @extends Factory
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'price' => $price = $this->faker->numberBetween(10000, 10000000),
            'quantity' => $qu = $this->faker->numberBetween(1, 50),
            'total' => $price * $qu,
        ];
    }
}
