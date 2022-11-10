<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\User\Database\Seeders\ProvinceSeeder;
use Modules\User\Database\Seeders\AdminSeeder;
use Modules\User\Database\Seeders\ViewerUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolePermissionsSeeder::class ,
            AdminSeeder::class ,
            ViewerUserSeeder::class ,
            ProvinceSeeder::class,
        ]);
    }
}
