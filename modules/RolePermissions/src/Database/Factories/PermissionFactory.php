<?php

namespace Modules\RolePermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\RolePermissions\Models\Permission;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
       return [
            'name' => $this->faker->name
        ];
    }
}
