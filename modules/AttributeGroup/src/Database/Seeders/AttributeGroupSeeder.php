<?php

namespace Modules\AttributeGroup\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Category\Enums\CategoryStatus;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = __('AttributeGroup::default-data');
        foreach ($data as $attributeGroupName) {
           $attributeGroup =  AttributeGroup::query()->firstOrCreate([
                'name' => $attributeGroupName,
            ], [
            ]);

        }
    }
}
