<?php

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
            'amount' => $this->faker->numberBetween(10000, 10000000),
            'token' => Str::random(12),
            'gateway_name' => $this->faker->randomElement(['pay', 'zarinpal']),
            'pay_date' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'description' => $this->faker->text,
            'payment_type' => $this->faker->randomElement([ Payment::PAYMENT_TYPE_OFFLINE, Payment::PAYMENT_TYPE_ONLINE]),
            'status' => $this->faker->randomElement([Payment::STATUS_SUCCESS, Payment::STATUS_FAILED, Payment::STATUS_PENDING]),
        ];
    }
}
