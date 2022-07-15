<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Transaction;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Transaction::factory()->make()->toArray();

        Transaction::create($data);

        $this->assertDatabaseCount('transactions' , 1);
        $this->assertDatabaseHas('transactions' , $data);
    }
}
