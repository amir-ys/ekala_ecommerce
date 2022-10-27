<?php

namespace Modules\Coupon\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\CommonDiscount;
use Modules\Payment\Models\Order;
use Tests\TestCase;

class CommonDiscountTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = CommonDiscount::factory()->make()->toArray();

        CommonDiscount::create($data);

        $this->assertDatabaseCount('common_discounts', 1);
        $this->assertDatabaseHas('common_discounts', $data);
    }

    public function test_order_relation_with_order_items()
    {
        $count = rand(1, 9);
        $coupon = CommonDiscount::factory()->has(Order::factory()->count($count) , 'orders')->create();

        $this->assertCount($count , $coupon->orders);
        $this->assertInstanceOf(Order::class , $coupon->orders->first() );
    }
}
