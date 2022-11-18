<?php

namespace Modules\Attribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Brand\Enums\BrandStatus;
use Modules\Brand\Models\Brand;
use Modules\Category\Enums\CategoryStatus;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

class AttributeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = __('Attribute::default-data');
        foreach ($data as $attributeName) {
           $attributeGroup =  Attribute::query()->firstOrCreate([
                'name' => $attributeName,
                'attribute_group_id' => AttributeGroup::query()->inRandomOrder()->first()->id,
                'is_filterable' => Attribute::FILTERABLE_TRUE,
            ], [
            ]);

        }
    }
}
