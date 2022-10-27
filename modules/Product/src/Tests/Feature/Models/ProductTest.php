<?php

namespace Modules\Product\Tests\Feature\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Comment\Models\Comment;
use Modules\Payment\Models\OrderItem;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Product::factory()->make()->toArray();
        $data['slug'] = SlugService::createSlug(Product::class, 'slug', 'name');
        Product::create($data);

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', $data);
    }

    public function test_product_relation_with_brand()
    {
        $product = Product::factory()->for(Brand::factory())->create();

        $this->assertTrue(isset($product->brand->id));
        $this->assertInstanceOf(Brand::class, $product->brand);
    }

    public function test_product_relation_with_category()
    {
        $product = Product::factory()->for(Category::factory())->create();

        $this->assertTrue(isset($product->category->id));
        $this->assertInstanceOf(Category::class, $product->category);
    }

    public function test_product_relation_with_productImage()
    {
        $count = rand(1, 9);
        $product = Product::factory()->has(ProductImage::factory()->state(['is_primary' => 0])->count($count),
            'images')->create();

        $this->assertCount($count, $product->images);
        $this->assertInstanceOf(ProductImage::class, $product->images->first());
    }

    public function test_product_relation_with_attributes()
    {
        $count = rand(1, 9);
        $product = Product::factory()->hasAttached(Attribute::factory()->count($count),
            ['value' => '::test::'], 'attributes')->create();

        $this->assertCount($count, $product->attributes);
        $this->assertInstanceOf(Attribute::class, $product->attributes->first());
    }

    public function test_product_relation_with_comment()
    {
        $count = rand(1, 9);
        $product = Product::factory()->has(Comment::factory()->count($count), 'comments')->create();

        $this->assertCount($count, $product->comments);
        $this->assertInstanceOf(Comment::class, $product->comments()->first());
    }

    public function test_product_relation_with_order_items()
    {
        $count = rand(1, 9);
        $product = Product::factory()->has(OrderItem::factory()->count($count) , 'orderDetails')->create();

        $this->assertCount($count , $product->orderDetails);
        $this->assertInstanceOf(OrderItem::class , $product->orderDetails->first() );
    }
}
