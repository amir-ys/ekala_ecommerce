<?php

namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;
use Modules\User\Models\User;
use Tests\TestCase;

class ProductColorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $response = $this->get(route('panel.products.colors.index', $product->id));

        $response->assertViewIs('Product::product-colors.index')
            ->assertViewHas([
                'colors' => ProductColor::query()->latest()->get()
            ]);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $response = $this->get(route('panel.products.colors.create', $product->id));
        $response->assertViewIs('Product::product-colors.create');
    }

    public function test_product_can_be_store()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $data = ProductColor::factory()->make()->toArray();
        $this->post(route('panel.products.colors.store', $product->id), $data);
        $data['product_id'] = $product->id;
        $this->assertDatabaseCount('product_colors', 1);
        $this->assertDatabaseHas('product_colors', $data);
    }

    public function test_edit_method()
    {
        $this->withoutExceptionHandling();

        $this->actingAsUser();
        $product = $this->createProduct();
        $color = ProductColor::factory()->state(['product_id' => $product->id])->create();
        $response = $this->get(route('panel.products.colors.edit', [$product->id, $color->id]));

        $response->assertViewIs('Product::product-colors.edit')
            ->assertViewHasAll([
                'color' => $color,
                'product' => $product,
            ]);

    }

    public function test_post_can_be_update()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $color = ProductColor::factory()->state(['product_id' => $product->id])->create();
        $data = ProductColor::factory()->make()->toArray();

        $response = $this->patch(route('panel.products.colors.update', [$product->id, $color->id]), $data);

        $data['product_id'] = $product->id;
        $response->assertRedirect();
        $this->assertDatabaseCount('product_colors', 1);
        $this->assertDatabaseHas('product_colors', $data);
    }

    public function test_product_can_be_delete()
    {
        $this->actingAsUser();
        $product = $this->createProduct();
        $this->withoutExceptionHandling();
        $color = ProductColor::factory()->state(['product_id' => $product->id])->create();

        $this->delete(route('panel.products.colors.destroy', [$product->id, $color->id]));
        $this->assertSoftDeleted($color->getTable());
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
