<?php

namespace Modules\Otp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Otp\Models\Otp;

/**
 * @extends Factory
 */
class OtpFactory extends Factory
{
    protected $model = Otp::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone_number' => '09' . $this->faker->numerify('#########'),
            'code' => $this->faker->numerify('######')
        ];
    }
}
