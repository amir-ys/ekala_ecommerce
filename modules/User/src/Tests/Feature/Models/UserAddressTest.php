<?php
namespace Modules\User\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
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


}
