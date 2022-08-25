<?php

namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Delivery;
use Modules\User\Models\User;
use Tests\TestCase;

class DeliveryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.delivery.index'));

        $response->assertViewIs('Product::delivery.index')
            ->assertViewHas([
                'delivery_methods' => Delivery::query()->latest()->get()
            ]);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.delivery.create'));
        $response->assertViewIs('Product::delivery.create');
    }

    public function test_product_can_be_store()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $data = Delivery::factory()->make()->toArray();
        $this->post(route('panel.delivery.store'), $data);

        $this->assertDatabaseCount('delivery', 1);
        $this->assertDatabaseHas('delivery', $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $delivery = Delivery::factory()->create();
        $response = $this->get(route('panel.delivery.edit', $delivery->id));

        $response->assertViewIs('Product::delivery.edit')
            ->assertViewHasAll([
                'delivery' => $delivery,
            ]);

    }

    public function test_post_can_be_update()
    {
        $this->actingAsUser();
        $delivery = Delivery::factory()->create();
        $data = Delivery::factory()->make()->toArray();

        $response = $this->patch(route('panel.delivery.update', $delivery->id), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('delivery', 1);
        $this->assertDatabaseHas('delivery', $data);
    }

    public function test_product_can_be_delete()
    {
        $this->actingAsUser();
        $this->withoutExceptionHandling();
        $delivery = Delivery::factory()->create();

        $this->delete(route('panel.delivery.destroy', $delivery->id));
        $this->assertSoftDeleted($delivery->getTable());
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
