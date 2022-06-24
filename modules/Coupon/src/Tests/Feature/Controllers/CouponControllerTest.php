<?php

namespace Modules\Coupon\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\Coupon;
use Modules\User\Models\User;
use Tests\TestCase;

class CouponControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.coupons.index'));

        $response->assertViewIs('Coupon::index')
            ->assertViewHas('coupons', Coupon::query()->latest()->get());
    }

    private function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.coupons.create'));
        $response->assertViewIs('Coupon::create');
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Coupon::factory()->make()->toArray();
        $response = $this->post(route('panel.coupons.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('coupons', 1);
        $this->assertDatabaseHas('coupons', $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $coupon = Coupon::factory()->create();

        $response = $this->get(route('panel.coupons.edit', $coupon->id));

        $response->assertViewIs('Coupon::edit')
            ->assertViewHas('coupon', $coupon);
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $coupon = Coupon::factory()->create();
        $data = Coupon::factory()->make()->toArray();

        $response = $this->patch(route('panel.coupons.update', $coupon->id), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('coupons', 1);
        $this->assertDatabaseHas('coupons', $data);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $coupon = Coupon::factory()->create();

        $response = $this->delete(route('panel.coupons.destroy', $coupon->id));
        $response->assertJson([
            'message' => "کوین " . $coupon->name . " با موفقیت حذف شد."
        ]);
        $this->assertDatabaseCount('coupons', 0);
        $this->assertDatabaseMissing('coupons', $coupon->toArray());
    }
}
