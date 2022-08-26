<?php

namespace Modules\Coupon\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Coupon\Models\CommonDiscount;

/**
 * @extends Factory
 */
class CommonDiscountFactory extends Factory
{
    protected $model = CommonDiscount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'percent' => $this->faker->numberBetween(1, 100),
            'discount_ceiling' => $this->faker->numberBetween(10000, 500000),
            'minimal_order_amount' => $this->faker->numberBetween(10000, 30000),
            'status' => $this->faker->randomElement(CommonDiscount::$statuses),
            'start_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'end_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
