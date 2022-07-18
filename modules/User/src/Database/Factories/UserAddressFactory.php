<?php
namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\UserAddress;

/**
 * @extends Factory
 */
class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => UserAddress::factory(),
            'province_id' => $this->faker->city,
            'city_id' => $this->faker->city,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address ,
            'postal_code' => $this->faker->postcode ,
            'receiver' => $this->faker->name() ,
            'is_active' => $this->faker->randomElement([UserAddress::STATUS_INACTIVE , UserAddress::STATUS_ACTIVE]),
        ];
    }

}
