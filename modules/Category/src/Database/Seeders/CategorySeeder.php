<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Modules\Category\Enums\CategoryStatus;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = __('Category::default-data');
        foreach ($data as $category) {
            Category::query()->firstOrCreate([
                'name' => $category,

            ], [
                'parent_id' => null,
                'is_active' => CategoryStatus::ACTIVE,
                'is_searchable' => Category::SEARCHABLE_TRUE
            ]);
        }
    }
}
