<?php

namespace Modules\Discount\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\CommonDiscount;
use Modules\User\Models\User;
use Tests\TestCase;

class CommonDiscountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $response = $this->get(route('panel.commonDiscounts.index'));

        $response->assertViewIs('Discount::common-discounts.index')
            ->assertViewHas('discounts', CommonDiscount::query()->latest()->get());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.commonDiscounts.create'));
        $response->assertViewIs('Discount::common-discounts.create');
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = CommonDiscount::factory()->make()->toArray();
        $response = $this->post(route('panel.commonDiscounts.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('common_discounts', 1);
        $this->assertDatabaseHas('common_discounts', $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $discount = CommonDiscount::factory()->create();

        $response = $this->get(route('panel.commonDiscounts.edit', $discount->id));

        $response->assertViewIs('Discount::common-discounts.edit')
            ->assertViewHas('discount', $discount);
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $discount = CommonDiscount::factory()->create();
        $data = CommonDiscount::factory()->make()->toArray();

        $response = $this->patch(route('panel.commonDiscounts.update', $discount->id), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('common_discounts', 1);
        $this->assertDatabaseHas('common_discounts', $data);
    }

    public function test_destroy_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $discount = CommonDiscount::factory()->create();

        $response = $this->delete(route('panel.commonDiscounts.destroy', $discount->id));
        $response->assertJson([
            'message' => "تخفیف " . $discount->title . " با موفقیت حذف شد."
        ]);
        $this->assertDatabaseCount('common_discounts', 0);
        $this->assertDatabaseMissing('common_discounts', $discount->toArray());
    }


    private function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
