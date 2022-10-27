<?php

namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\Product\Models\Product;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class ProductAttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_method()
    {
        $this->actingAsUser();
        $product = Product::factory()->create();
        $response = $this->get(route('panel.products.attributes.show', $product->id));

        $response->assertViewIs('Product::attributes.show')
            ->assertViewHas([
                'product' => $product
            ]);
    }

    public function test_product_attribute_can_save()
    {
        $this->actingAsUser();
        $product = Product::factory()->create();
        $attribute = Attribute::factory()->create();
        $data = ['attributes' => [$attribute->id => '::attribute-value::']];
        $this->post(route('panel.products.attributes.save', $product->id), $data);

        $this->assertDatabaseCount('attribute_product', 1);
        $this->assertDatabaseHas('attribute_product', ['product_id' => $product->id,
            'attribute_id' => $attribute->id, 'value' => $data['attributes'][$attribute->id]]);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
        $this->actingAs($user);
    }
}
