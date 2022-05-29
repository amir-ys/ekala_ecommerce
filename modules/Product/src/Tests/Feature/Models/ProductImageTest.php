<?php
namespace Modules\Product\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = ProductImage::factory()->make()->toArray();
        ProductImage::create($data);

        $this->assertDatabaseCount('product_images' , 1);
        $this->assertDatabaseHas('product_images' , $data);
    }

    public function test_product_relation_with_brand()
    {
        $product = Product::factory()->for(Brand::factory())->create();

        $this->assertTrue(isset($product->brand->id));
        $this->assertInstanceOf(Brand::class , $product->brand);
    }


    public function test_productImage_relation_with_product()
    {
        $productImage = ProductImage::factory()->for(Product::factory() , 'product')->create();

        $this->assertTrue(isset($productImage->product->id));
        $this->assertInstanceOf(Product::class , $productImage->product);
    }
}
