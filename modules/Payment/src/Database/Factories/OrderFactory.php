<?php

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Coupon\Models\Coupon;
use Modules\Payment\Models\Order;
use Modules\User\Models\User;

/**
 * @extends Factory
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'coupon_id' => Coupon::factory(),
            'status' => $this->faker->randomElement([Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_SUCCESS]),
            'total_amount' => $this->faker->numberBetween(10000, 500000),
            'coupon_amount' => $this->faker->numberBetween(10000, 500000),
            'paying_amount' => $this->faker->numberBetween(10000, 500000),
            'payment_type' => $this->faker->randomElement(['pay', 'zarinpal']),
        ];
    }
}
