<?php

namespace Modules\RolePermissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RolePermissions\Models\Permission;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::$permissions as $permission) {
            Permission::findOrCreate($permission);
        }

    }
}
