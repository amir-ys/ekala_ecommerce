<?php

namespace Modules\Product\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;
use Tests\TestCase;

class ProductColorTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = ProductColor::factory()->make()->toArray();
        ProductColor::create($data);

        $this->assertDatabaseCount('product_colors', 1);
        $this->assertDatabaseHas('product_colors', $data);
    }

    public function test_productColor_relation_with_product()
    {
        $productImage = ProductColor::factory()->for(Product::factory(), 'product')->create();

        $this->assertTrue(isset($productImage->product->id));
        $this->assertInstanceOf(Product::class, $productImage->product);
    }
}
