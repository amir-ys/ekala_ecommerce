<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Attribute\Database\Seeders\AttributeSeeder;
use Modules\AttributeGroup\Database\Seeders\AttributeGroupSeeder;
use Modules\Brand\Database\Seeders\BrandSeeder;
use Modules\Category\Database\Seeders\CategorySeeder;
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
            RolePermissionsSeeder::class,
            AdminSeeder::class,
            ViewerUserSeeder::class,
            ProvinceSeeder::class,
            CategorySeeder::class,
            AttributeGroupSeeder::class,
            AttributeSeeder::class ,
            BrandSeeder::class,
        ]);
    }
}
