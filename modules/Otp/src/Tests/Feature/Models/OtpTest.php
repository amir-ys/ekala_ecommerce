<?php

namespace Modules\Otp\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Otp\Models\Otp;
use Tests\TestCase;

class OtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Otp::factory()->make()->toArray();

        Otp::create($data);

        $this->assertDatabaseCount('otps', 1);
        $this->assertDatabaseHas('otps', $data);

    }
}
