<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\OrderItem;
use Modules\Product\Models\Product;
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

    public function test_order_item_relation_with_order()
    {
        $item = OrderItem::factory()->for(Order::factory())->create();

        $this->assertInstanceOf(Order::class , $item->order );
        $this->assertTrue(isset($item->order->id));
    }


    public function test_order_item_relation_with_product()
    {
        $item = OrderItem::factory()->for(Product::factory())->create();

        $this->assertInstanceOf(Product::class , $item->product );
        $this->assertTrue(isset($item->product->id));
    }
}
