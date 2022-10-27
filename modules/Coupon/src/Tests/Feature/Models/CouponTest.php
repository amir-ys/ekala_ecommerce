<?php

namespace Modules\Coupon\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\Coupon;
use Modules\Payment\Models\Order;
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

    public function test_order_relation_with_order_items()
    {
        $count = rand(1, 9);
        $coupon = Coupon::factory()->has(Order::factory()->count($count) , 'orders')->create();

        $this->assertCount($count , $coupon->orders);
        $this->assertInstanceOf(Order::class , $coupon->orders->first() );
    }
}
