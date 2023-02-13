<?php

namespace Modules\Otp\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Otp\Facades\OtpServiceFacades;
use Tests\TestCase;

class OtpServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_otp_code_expired_after_specified_time()
    {
        $phoneNumber = '09121001010';
        $otp = OtpServiceFacades::requestOtp($phoneNumber);
        $data = ['phone_number' => $phoneNumber , 'code' =>$otp->code];

        $this->assertDatabaseCount('otps'  , 1);
        $this->assertDatabaseHas('otps'  , $data);

        $this->travel(config('otp.expiration_time') + 10)->seconds();

        $newOtp = OtpServiceFacades::requestOtp($phoneNumber);
        $newData = ['phone_number' => $phoneNumber , 'code' =>$newOtp->code];


        $this->assertDatabaseCount('otps'  , 1);
        $this->assertDatabaseHas('otps'  , $newData);
        $this->assertDatabaseMissing('otps'  , $data);
    }

    public function test_otp_code_not_expired_before_specified_time()
    {
        $phoneNumber = '09121001010';
        $otp = OtpServiceFacades::requestOtp($phoneNumber);
        $data = ['phone_number' => $phoneNumber , 'code' =>$otp->code];

        $this->assertDatabaseCount('otps'  , 1);
        $this->assertDatabaseHas('otps'  , $data);

        $this->travel(config('otp.expiration_time') - 5)->seconds();

        $newOtp = OtpServiceFacades::requestOtp($phoneNumber);
        $newData = ['phone_number' => $phoneNumber , 'code' =>$newOtp->code];

        $this->assertEquals($data , $newData);
        $this->assertDatabaseCount('otps'  , 1);
        $this->assertDatabaseHas('otps'  , $newData);
        $this->assertDatabaseHas('otps'  , $data);
    }
}
