<?php

namespace Modules\Brand\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Brand\Enums\BrandStatus;
use Modules\Brand\Models\Brand;
use Modules\Category\Enums\CategoryStatus;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

class BrandSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = __('Brand::default-data');
        foreach ($data as $brandName) {
           $attributeGroup =  Brand::query()->firstOrCreate([
                'name' => $brandName,
                'is_active' => BrandStatus::ACTIVE,
            ], [
            ]);

        }
    }
}
