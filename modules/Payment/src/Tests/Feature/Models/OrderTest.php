<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
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
}
