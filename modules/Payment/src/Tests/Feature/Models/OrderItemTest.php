<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\OrderItem;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = OrderItem::factory()->make()->toArray();

        OrderItem::create($data);

        $this->assertDatabaseCount('order_items', 1);
        $this->assertDatabaseHas('order_items', $data);
    }
}
