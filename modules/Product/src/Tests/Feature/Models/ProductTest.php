<?php
namespace Modules\Product\Tests\Feature\Models;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Tests\TestCase;

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
        $product = Product::factory()->for(Brand::factory())->create();

        $this->assertTrue(isset($product->brand->id));
        $this->assertInstanceOf(Brand::class , $product->brand);
    }

    public function test_product_relation_with_category()
    {
        $product = Product::factory()->for(Category::factory())->create();

        $this->assertTrue(isset($product->category->id));
        $this->assertInstanceOf(Category::class , $product->category);
    }

    public function test_product_relation_with_productImage()
    {
        $count = rand(1 ,9);
        $product = Product::factory()->has(ProductImage::factory()->state(['is_primary' => 0])->count($count), 'images')->create();

        $this->assertCount($count , $product->images);
        $this->assertInstanceOf(ProductImage::class , $product->images->first());
    }

}
