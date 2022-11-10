<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $user = User::query()->firstOrCreate([
           'email' => 'admin@ekala.com' ,
        ] ,
       [
           'password' => bcrypt(123456) ,
           'email_verified_at' => now() ,
           'is_admin' => User::ROLE_ADMIN
       ]);

       $user->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);

    }
}
