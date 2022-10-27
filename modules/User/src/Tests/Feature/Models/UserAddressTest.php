<?php
namespace Modules\User\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
use Modules\User\Models\UserAddress;
use Tests\TestCase;

class UserAddressTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = UserAddress::factory()->make()->toArray();

        UserAddress::create($data);

        $this->assertDatabaseCount('user_addresses' , 1);
        $this->assertDatabaseHas('user_addresses' ,  $data);
    }


    public function test_user_address_relation_with_order()
    {
        $count = rand(1,9);
        $user = UserAddress::factory()->has(Order::factory()->count($count) , 'orders')->create();

        $this->assertCount($count , $user->orders);
        $this->assertTrue(isset($user->orders->first()->id));
    }


}
