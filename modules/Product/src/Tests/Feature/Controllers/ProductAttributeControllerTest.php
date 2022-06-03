<?php
namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Product;
use Tests\TestCase;

class ProductAttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_method()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory()->create();
        $response = $this->get(route('panel.products.attributes.show' , $product->id));

        $response->assertViewIs('Product::attributes.show')
            ->assertViewHas([
                'product' => $product
            ]);
    }
}
