<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Attribute::factory()->count(rand(1, 10))->create();
        Category::factory()->count(rand(1, 10))->create();
        AttributeGroup::factory()->count(rand(1, 10))->create();
        Brand::factory()->count(rand(1, 10))->create();
        Attribute::factory()->count(rand(1, 10))->create();
        Product::factory()->count(rand(1, 10))->create();
    }
}
