<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Payment::factory()->make()->toArray();

        Payment::create($data);

        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseHas('payments', $data);
    }

    public function test_payment_relation_with_order()
    {
        $count = rand(1, 9);
        $payment = Payment::factory()->has(Order::factory()->count($count))->create();

        $this->assertCount($count , $payment->orders);
        $this->assertTrue(isset($payment->orders->first()->id));
    }


    public function test_payment_relation_with_user()
    {
        $payment = Payment::factory()->for(User::factory())->create();

        $this->assertTrue(isset($payment->user->id));
        $this->assertInstanceOf(User::class, $payment->user);
    }
}
