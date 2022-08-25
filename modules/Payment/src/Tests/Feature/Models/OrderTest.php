<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Order::factory()->make()->toArray();

        Order::create($data);

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseHas('orders', $data);
    }
}
