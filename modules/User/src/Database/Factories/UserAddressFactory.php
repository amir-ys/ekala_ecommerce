<?php
namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;
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
            'user_id' => User::factory(),
            'province_id' => $province = Province::query()->create(['name' => 'tehran']),
            'city_id' => City::query()->create(['name' => 'eslam shahr' , 'province_id' => $province->id]),
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address ,
            'postal_code' => $this->faker->postcode ,
            'receiver' => $this->faker->name() ,
            'is_active' => $this->faker->randomElement([UserAddress::STATUS_INACTIVE , UserAddress::STATUS_ACTIVE]),
        ];
    }

}
