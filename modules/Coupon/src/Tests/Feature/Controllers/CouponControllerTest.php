<?php

namespace Modules\Coupon\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\Coupon;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Morilog\Jalali\Jalalian;
use Tests\TestCase;

class CouponControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.coupons.index'));

        $response->assertViewIs('Coupon::coupons.index')
            ->assertViewHas('coupons', Coupon::query()->latest()->get());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.coupons.create'));
        $response->assertViewIs('Coupon::coupons.create');
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Coupon::factory()->make()->toArray();

        $data['start_date'] = (new Jalalian(1396 , 3 ,5 , 12 ,06))->format('Y/m/d H:i');
        $data['end_date'] = (new Jalalian(1399 , 3 ,5 , 07 ,30))->format('Y/m/d H:i');
        $response = $this->post(route('panel.coupons.store'), $data);

        $data['start_date'] = convertJalaliToDate($data['start_date'] , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($data['end_date'] , 'Y/m/d H:i' );

        $response->assertRedirect();
        $this->assertDatabaseCount('coupons', 1);
        $this->assertDatabaseHas('coupons', $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $coupon = Coupon::factory()->create();

        $response = $this->get(route('panel.coupons.edit', $coupon->id));

        $response->assertViewIs('Coupon::coupons.edit')
            ->assertViewHas('coupon', $coupon);
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $coupon = Coupon::factory()->create();
        $data = Coupon::factory()->make()->toArray();

        $data['start_date'] = (new Jalalian(1396 , 3 ,5 , 12 ,06))->format('Y/m/d H:i');
        $data['end_date'] = (new Jalalian(1399 , 3 ,5 , 07 ,30))->format('Y/m/d H:i');
        $response = $this->patch(route('panel.coupons.update', $coupon->id), $data);

        $data['start_date'] = convertJalaliToDate($data['start_date'] , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($data['end_date'] , 'Y/m/d H:i' );

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
        $this->assertCount(0, Coupon::all());
        $this->assertDatabaseMissing('coupons', $coupon->toArray());
    }


    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COUPONS);
        $this->actingAs($user);
    }
}
