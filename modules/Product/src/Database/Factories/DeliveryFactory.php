<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Delivery;

/**
 * @extends Factory
 */
class DeliveryFactory extends Factory
{
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(1000, 50000),
            'delivery_time' => $this->faker->numberBetween(1, 99),
            'delivery_unit' => $this->faker->randomElement(['day', 'hours', 'week']),
            'status' => $this->faker->randomElement(Delivery::$statuses),
        ];
    }
}
