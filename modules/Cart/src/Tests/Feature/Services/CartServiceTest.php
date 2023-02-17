<?php

namespace Modules\Cart\Tests\Feature\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Cart\Facades\CartServiceFacade;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;
use Modules\Product\Models\ProductWarranty;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_total_of_amount_cart()
    {
        $this->assertEquals(CartServiceFacade::getTotal(), 0);

        $data = $this->addAItemToCart();
        $this->assertEquals(CartServiceFacade::getTotal(), $data['total_amount']);
    }

    public function test_cart_is_empty_method()
    {
        $this->assertTrue(CartServiceFacade::isEmpty());

        $data = $this->addAItemToCart();
        $this->assertFalse(CartServiceFacade::isEmpty());
    }

    public function test_remove_a_item_from_cart()
    {
        $data = $this->addAItemToCart();
        $this->assertFalse(CartServiceFacade::isEmpty());
        CartServiceFacade::remove($data['id']);
        $this->assertTrue(CartServiceFacade::isEmpty());
    }

    public function test_clear_all_items_from_cart()
    {
        $this->addAItemToCart();
        $this->addAItemToCart();
        $this->assertFalse(CartServiceFacade::isEmpty());
        CartServiceFacade::clearAll();
        $this->assertTrue(CartServiceFacade::isEmpty());
    }

    public function test_get_items_cart_method()
    {
        $this->assertEmpty(CartServiceFacade::getItems());
        $this->addAItemToCart();
        $this->assertNotEmpty(CartServiceFacade::getItems());
    }

    public function test_update_quantity_in_cart()
    {
        $data = $this->addAItemToCart();
        $this->assertEquals(CartServiceFacade::getItems()[$data['id']]['quantity'], $data['quantity']);
        CartServiceFacade::update([$data['id'] => $quantity = 5]);
        $this->assertEquals(CartServiceFacade::getItems()[$data['id']]['quantity'], $quantity);
    }

    public function test_add_a_item_to_cart()
    {
        $product = Product::factory()->create(['is_active' => ProductStatus::ACTIVE, 'is_marketable' => Product::MARKETABLE]);
        $productColor = ProductColor::factory()->create(['product_id' => $product->id]);
        $productWarranty = ProductWarranty::factory()->create(['product_id' => $product->id]);

        $inputs = ['quantity' => 2, 'color_id' => $productColor->id, 'warranty_id' => $productWarranty->id,];
        $cart = CartServiceFacade::add($product, $inputs);

        $this->assertNotEmpty($cart);
    }

    public function addAItemToCart(): array
    {
        $product = Product::factory()->create(['is_active' => ProductStatus::ACTIVE, 'is_marketable' => Product::MARKETABLE]);
        $productColor = ProductColor::factory()->create(['product_id' => $product->id]);
        $productWarranty = ProductWarranty::factory()->create(['product_id' => $product->id]);

        $inputs = ['quantity' => 2, 'color_id' => $productColor->id, 'warranty_id' => $productWarranty->id,];
        CartServiceFacade::add($product, $inputs);

        $inputs['id'] = $product->id . $productColor->id . $productWarranty->id;
        $inputs['total_amount'] = CartServiceFacade::getItems()[$inputs['id']]['price'] * CartServiceFacade::getItems()[$inputs['id']]['quantity'];

        return $inputs;
    }
}
