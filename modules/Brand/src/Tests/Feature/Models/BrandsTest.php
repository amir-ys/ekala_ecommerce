<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Modules\Product\Models\Product;
use Tests\TestCase;

class BrandsTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Brand::factory()->make()->toArray();

        Brand::create($data);

        $this->assertDatabaseCount('brands' , 1);
        $this->assertDatabaseHas('brands' , $data);
    }

    public function test_brand_relation_with_Product()
    {
        $count = rand(2, 9);
        $brand = Brand::factory()->has(Product::factory()->count($count))->create();

        $this->assertCount($count ,$brand->products);
        $this->assertInstanceOf(Product::class , $brand->products->first());
    }
}
