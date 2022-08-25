<?php

namespace Modules\Delivery\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Models\Delivery;
use Tests\TestCase;

class DeliveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Delivery::factory()->make()->toArray();
        Delivery::create($data);

        $this->assertDatabaseCount('delivery', 1);
        $this->assertDatabaseHas('delivery', $data);
    }

}
