<?php

namespace Modules\Coupon\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Coupon\Models\Coupon;

/**
 * @extends Factory
 */
class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomElement,
            'type' => $this->faker->randomElement(Coupon::$types),
            'use_type' => Coupon::USE_TYPE_PUBLIC,
            'amount' => $this->faker->numberBetween(100000, 2000000),
            'percent' => $this->faker->numberBetween(0, 100),
            'discount_ceiling' => $this->faker->numberBetween(10000, 50000),
            'start_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'end_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'status' => $this->faker->randomElement(Coupon::$statuses),
        ];
    }
}
