<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Payment;
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
}
