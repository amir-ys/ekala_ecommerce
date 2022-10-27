<?php

namespace Modules\Discount\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\CommonDiscount;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Morilog\Jalali\Jalalian;
use Tests\TestCase;

class CommonDiscountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
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
        $data['start_date'] = (new Jalalian(1396 , 3 ,5 , 12 ,06))->format('Y/m/d H:i');
        $data['end_date'] = (new Jalalian(1399 , 3 ,5 , 07 ,30))->format('Y/m/d H:i');
        $response = $this->post(route('panel.commonDiscounts.store'), $data);

        $data['start_date'] = convertJalaliToDate($data['start_date'] , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($data['end_date'] , 'Y/m/d H:i' );
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

        $data['start_date'] = (new Jalalian(1396 , 3 ,5 , 12 ,06))->format('Y/m/d H:i');
        $data['end_date'] = (new Jalalian(1399 , 3 ,5 , 07 ,30))->format('Y/m/d H:i');
        $response = $this->patch(route('panel.commonDiscounts.update', $discount->id), $data);

        $data['start_date'] = convertJalaliToDate($data['start_date'] , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($data['end_date'] , 'Y/m/d H:i' );

        $response->assertRedirect();
        $this->assertDatabaseCount('common_discounts', 1);
        $this->assertDatabaseHas('common_discounts', $data);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $discount = CommonDiscount::factory()->create();

        $response = $this->delete(route('panel.commonDiscounts.destroy', $discount->id));
        $response->assertJson([
            'message' => "تخفیف " . $discount->title . " با موفقیت حذف شد."
        ]);
        $this->assertCount(0, CommonDiscount::all());
        $this->assertDatabaseMissing('common_discounts', $discount->toArray());
    }


    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COUPONS);
        $this->actingAs($user);
    }
}
