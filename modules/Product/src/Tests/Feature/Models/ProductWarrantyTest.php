<?php

namespace Modules\Product\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductWarranty;
use Tests\TestCase;

class ProductWarrantyTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = ProductWarranty::factory()->make()->toArray();
        ProductWarranty::create($data);

        $this->assertDatabaseCount('product_warranties', 1);
        $this->assertDatabaseHas('product_warranties', $data);
    }

    public function test_productWarranty_relation_with_product()
    {
        $productWarranty = ProductWarranty::factory()->for(Product::factory(), 'product')->create();

        $this->assertTrue(isset($productWarranty->product->id));
        $this->assertInstanceOf(Product::class, $productWarranty->product);
    }
}
