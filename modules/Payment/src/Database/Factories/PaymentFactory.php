<?php

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;

/**
 * @extends Factory
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_id' => Order::factory(),
            'amount' => $this->faker->numberBetween(10000, 10000000),
            'ref_id' => Str::random(12),
            'token' => Str::random(12),
            'gateway_name' => $this->faker->randomElement(['pay', 'zarinpal']),
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([Payment::STATUS_SUCCESS, Payment::STATUS_FAILED, Payment::STATUS_PENDING]),
        ];
    }
}
