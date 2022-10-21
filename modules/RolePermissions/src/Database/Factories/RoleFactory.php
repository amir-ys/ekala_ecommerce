<?php

namespace Modules\RolePermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\RolePermissions\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
       return [
            'name' => $this->faker->name
        ];
    }
}
