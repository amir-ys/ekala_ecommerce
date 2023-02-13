<?php

namespace Modules\Otp\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticateOtpControllerTest  extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_login_otp_form()
    {
        $this->get(route('front.otp.showLoginForm'))
        ->assertViewIs('Otp::login');
    }

    public function test_request_otp()
    {
        $phone_number = '09121001010';
        $this->postJson(route('front.otp.request') , ['phone_number' =>$phone_number ])
            ->assertViewIs('Otp::confirm');

        $this->assertDatabaseCount('otps' , 1);
        $this->assertDatabaseHas('otps' , ['phone_number' => $phone_number]);
    }

}
