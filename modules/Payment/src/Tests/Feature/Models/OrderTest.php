<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\CommonDiscount;
use Modules\Coupon\Models\Coupon;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\OrderItem;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;
use Modules\User\Models\UserAddress;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $user = User::factory()->create();
        $userAddress = UserAddress::factory()->state(['user_id' => $user->id])->create();
        $payment = Payment::factory()->state(['user_id' => $user->id])->create();
        $data = Order::factory()->state(['user_id' => $user->id ,
            'user_address_id' => $userAddress->id , 'payment_id' => $payment->id ])->make()->toArray();

        Order::create($data);

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseHas('orders', $data);
    }

    public function test_order_relation_with_order_items()
    {
        $count = rand(1, 9);
        $order = Order::factory()->has(OrderItem::factory()->count($count) , 'items')->create();

        $this->assertCount($count , $order->items);
        $this->assertInstanceOf(OrderItem::class , $order->items->first() );
    }

    public function test_order_relation_with_user()
    {
        $order = Order::factory()->for(User::factory())->create();

        $this->assertInstanceOf(User::class , $order->user );
        $this->assertTrue(isset($order->user->id));
    }

    public function test_order_relation_with_payment()
    {
        $order = Order::factory()->for(Payment::factory())->create();

        $this->assertInstanceOf(Payment::class , $order->payment );
        $this->assertTrue(isset($order->payment->id));
    }

    public function test_order_relation_with_user_address()
    {
        $order = Order::factory()->for(UserAddress::factory())->create();

        $this->assertInstanceOf(UserAddress::class , $order->userAddress );
        $this->assertTrue(isset($order->userAddress->id));
    }

    public function test_order_relation_with_coupon()
    {
        $order = Order::factory()->for(Coupon::factory())->create();

        $this->assertInstanceOf(Coupon::class , $order->coupon );
        $this->assertTrue(isset($order->coupon->id));
    }

    public function test_order_relation_with_common_discount()
    {
        $order = Order::factory()->for(CommonDiscount::factory())->create();

        $this->assertInstanceOf(CommonDiscount::class , $order->commonDiscount );
        $this->assertTrue(isset($order->commonDiscount->id));
    }

}
