<?php

namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductWarranty;
use Modules\User\Models\User;
use Tests\TestCase;

class ProductWarrantyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $response = $this->get(route('panel.products.warranties.index', $product->id));

        $response->assertViewIs('Product::warranties.index')
            ->assertViewHas([
                'warranties' => ProductWarranty::query()->latest()->get()
            ]);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $response = $this->get(route('panel.products.warranties.create', $product->id));
        $response->assertViewIs('Product::warranties.create');
    }

    public function test_product_can_be_store()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $data = ProductWarranty::factory()->make()->toArray();
        $this->post(route('panel.products.warranties.store', $product->id), $data);
        $data['product_id'] = $product->id;
        $this->assertDatabaseCount('product_warranties', 1);
        $this->assertDatabaseHas('product_warranties', $data);
    }

    public function test_edit_method()
    {
        $this->withoutExceptionHandling();

        $this->actingAsUser();
        $product = $this->createProduct();
        $warranty = ProductWarranty::factory()->state(['product_id' => $product->id])->create();
        $response = $this->get(route('panel.products.warranties.edit', [$product->id, $warranty->id]));

        $response->assertViewIs('Product::warranties.edit')
            ->assertViewHasAll([
                'warranty' => $warranty,
                'product' => $product,
            ]);

    }

    public function test_post_can_be_update()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $warranty = ProductWarranty::factory()->state(['product_id' => $product->id])->create();
        $data = ProductWarranty::factory()->make()->toArray();

        $response = $this->patch(route('panel.products.warranties.update', [$product->id, $warranty->id]), $data);

        $data['product_id'] = $product->id;
        $response->assertRedirect();
        $this->assertDatabaseCount('product_warranties', 1);
        $this->assertDatabaseHas('product_warranties', $data);
    }

    public function test_product_can_be_delete()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $this->withoutExceptionHandling();
        $warranty = ProductWarranty::factory()->state(['product_id' => $product->id])->create();

        $this->delete(route('panel.products.warranties.destroy', [$product->id, $warranty->id]));
        $this->assertSoftDeleted($warranty->getTable());
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function createProduct()
    {
        return Product::factory()->create();
    }
}
