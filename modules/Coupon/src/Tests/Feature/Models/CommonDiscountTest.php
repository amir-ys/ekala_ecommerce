<?php

namespace Modules\Coupon\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Coupon\Models\CommonDiscount;
use Tests\TestCase;

class CommonDiscountTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = CommonDiscount::factory()->make()->toArray();

        CommonDiscount::create($data);

        $this->assertDatabaseCount('common_discounts', 1);
        $this->assertDatabaseHas('common_discounts', $data);
    }
}
