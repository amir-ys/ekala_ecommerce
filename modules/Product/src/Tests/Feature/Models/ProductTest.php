<?php
namespace Modules\Product\Tests\Feature\Models;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Tests\TestCase;
use Modules\Product\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Product::factory()->make()->toArray();
        $data['slug'] = SlugService::createSlug(Product::class , 'slug' , 'name');
        Product::create($data);

        $this->assertDatabaseCount('products' , 1);
        $this->assertDatabaseHas('products' , $data);
    }

    public function test_product_relation_with_brand()
    {
        $count = rand(1, 9);
        $product = Product::factory()->for(Brand::factory())->create();

        $this->assertTrue(isset($product->brand->id));
        $this->assertInstanceOf(Brand::class , $product->brand);
    }

}
