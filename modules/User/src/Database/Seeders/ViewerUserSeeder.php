<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

class ViewerUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->firstOrCreate([
            'email' => 'viewer@ekala.com',
        ],
            [
                'password' => bcrypt(123456),
                'email_verified_at' => now(),
                'is_admin' => User::ROLE_ADMIN
            ]);

        $user->givePermissionTo([
            Permission::PERMISSION_READ_ATTRIBUTES,
            Permission::PERMISSION_READ_ATTRIBUTE_GROUPS,
            Permission::PERMISSION_READ_BRANDS,
            Permission::PERMISSION_READ_CATEGORIES,
            Permission::PERMISSION_READ_COMMENTS,
            Permission::PERMISSION_READ_COUPONS,
            Permission::PERMISSION_READ_PAYMENTS,
            Permission::PERMISSION_READ_PRODUCTS,
            Permission::PERMISSION_READ_SETTINGS,
            Permission::PERMISSION_READ_SLIDES,
            Permission::PERMISSION_READ_ROLE_PERMISSIONS,
            Permission::PERMISSION_READ_BLOG,
        ]);

    }
}
