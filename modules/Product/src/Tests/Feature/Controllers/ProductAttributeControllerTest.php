<?php
namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
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

    public function test_product_attribute_can_save()
    {
        $product = Product::factory()->create();
        $attribute =  Attribute::factory()->create();
        $data = [ 'attributes' => [ $attribute->id => '::attribute-value::' ] ];
        $this->post(route('panel.products.attributes.save' , $product->id) , $data);

        $this->assertDatabaseCount('attribute_product' , 1);
        $this->assertDatabaseHas('attribute_product' , [ 'product_id' =>$product->id ,
            'attribute_id' => $attribute->id , 'value' => $data['attributes'][$attribute->id]]);
    }
}
