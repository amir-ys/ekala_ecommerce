<?php
namespace Modules\User\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
use Modules\User\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = User::factory()->admin()->make()->toArray();
        $data['password'] = bcrypt(123456);
        User::create($data);

        $this->assertDatabaseCount('users' , 1);
        $this->assertDatabaseHas('users' ,  $data);
    }


    public function test_user_relation_with_order()
    {
        $count = rand(1,9);
        $user = User::factory()->has(Order::factory()->count($count))->create();

        $this->assertCount($count , $user->orders);
        $this->assertTrue(isset($user->orders->first()->id));
    }


}
