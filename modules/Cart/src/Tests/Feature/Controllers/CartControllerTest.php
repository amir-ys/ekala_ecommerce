<?php

namespace Modules\Cart\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Cart\Facades\CartServiceFacade;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;
use Modules\Product\Models\ProductWarranty;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_ca_see_index_page()
    {
        $this->get(route('front.cart.index'))
            ->assertViewIs('Front::cart.index')
            ->assertViewHasAll([
                'cartItems' => CartServiceFacade::getItems(),
                'suggestionProducts' => Product::all()
            ]);
    }

    public function test_quest_user_can_add_a_item_to_own_cart()
    {
        $product = Product::factory()->create(['is_active' => ProductStatus::ACTIVE, 'is_marketable' => Product::MARKETABLE]);
        $productColor = ProductColor::factory()->create(['product_id' => $product->id]);
        $productWarranty = ProductWarranty::factory()->create(['product_id' => $product->id]);

        $data = http_build_query([
            'product_id' => $product->id,
            'color_id' => $productColor->id,
            'warranty_id' => $productWarranty->id,
            'quantity' => $quantity = 2,
        ]);

        $this->get(route('front.cart.add') . "?$data")
            ->assertRedirect();

        $this->assertEquals(CartServiceFacade::getItems()[111]['quantity'] ,$quantity);
        $this->assertFalse(CartServiceFacade::isEmpty());
    }

    public function test_quest_user_can_clear_all_items_from_own_cart()
    {
        $product = Product::factory()->create(['is_active' => ProductStatus::ACTIVE, 'is_marketable' => Product::MARKETABLE]);
        $productColor = ProductColor::factory()->create(['product_id' => $product->id]);
        $productWarranty = ProductWarranty::factory()->create(['product_id' => $product->id]);

        $inputs = ['quantity' => 2, 'color_id' => $productColor->id, 'warranty_id' => $productWarranty->id,];
        CartServiceFacade::add($product, $inputs);

        $this->get(route('front.cart.clear'))
            ->assertRedirect();

        $this->assertTrue(!isset(CartServiceFacade::getItems()[111]));
        $this->assertTrue(CartServiceFacade::isEmpty());
    }

    public function test_quest_user_can_remove_a_item_from_own_cart()
    {
        $product = Product::factory()->create(['is_active' => ProductStatus::ACTIVE, 'is_marketable' => Product::MARKETABLE]);
        $productColor = ProductColor::factory()->create(['product_id' => $product->id]);
        $productWarranty = ProductWarranty::factory()->create(['product_id' => $product->id]);

        $inputs = ['quantity' => 1, 'color_id' => $productColor->id, 'warranty_id' => $productWarranty->id,];
        CartServiceFacade::add($product, $inputs);

        $this->get(route('front.cart.remove', 111))
            ->assertRedirect();


        $this->assertTrue(!isset(CartServiceFacade::getItems()[111]));
        $this->assertTrue(CartServiceFacade::isEmpty());
    }

    public function test_quest_user_can_update_quantity_a_item_from_own_cart()
    {
        $product = Product::factory()->create(['is_active' => ProductStatus::ACTIVE, 'is_marketable' => Product::MARKETABLE]);
        $productColor = ProductColor::factory()->create(['product_id' => $product->id]);
        $productWarranty = ProductWarranty::factory()->create(['product_id' => $product->id]);

        $inputs = ['quantity' => 1, 'color_id' => $productColor->id, 'warranty_id' => $productWarranty->id,];
        CartServiceFacade::add($product, $inputs);

        $data = http_build_query(['quantity' => ['111' => $quantity = 5]]);
        $this->get(route('front.cart.update') . "?$data")
            ->assertRedirect();

        $this->assertEquals(CartServiceFacade::getItems()[111]['quantity'], $quantity);
        $this->assertFalse(CartServiceFacade::isEmpty());
    }
}
