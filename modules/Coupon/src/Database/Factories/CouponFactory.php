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
            'amount' => $this->faker->numberBetween(100000, 2000000),
            'percent' => $this->faker->numberBetween(0, 100),
            'expired_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'description' => $this->faker->paragraph,
        ];
    }
}
