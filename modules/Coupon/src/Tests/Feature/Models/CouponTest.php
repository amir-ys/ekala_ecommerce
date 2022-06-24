<?php

namespace Modules\Coupon\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\Coupon;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Coupon::factory()->make()->toArray();

        Coupon::create($data);

        $this->assertDatabaseCount('coupons', 1);
        $this->assertDatabaseHas('coupons', $data);
    }
}
