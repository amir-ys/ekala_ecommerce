<?php

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Coupon\Models\CommonDiscount;
use Modules\Coupon\Models\Coupon;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;
use Modules\User\Models\UserAddress;

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
            'user_address_id' => UserAddress::factory(),
            'payment_id' => Payment::factory(),
            'final_amount' => $this->faker->numberBetween(10000, 5000000),
            'discount_amount' => $this->faker->numberBetween(10000, 500000),
            'coupon_id' => Coupon::factory(),
            'coupon_discount_amount' => $this->faker->numberBetween(10000, 500000),
            'common_discount_id' => CommonDiscount::factory(),
            'common_discount_amount' => $this->faker->numberBetween(10000, 500000),
            'status' => $this->faker->randomElement([Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_POSTED ]),
            'delivery_status' => $this->faker->randomElement([Order::DELIVERY_STATUS_SENDING, Order::DELIVERY_STATUS_NOT_SEND,
                            Order::DELIVERY_STATUS_DELIVERED , Order::DELIVERY_STATUS_POSTED ]),
        ];
    }
}
