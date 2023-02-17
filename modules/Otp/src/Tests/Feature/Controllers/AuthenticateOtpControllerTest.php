<?php

namespace Modules\Otp\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Notification\Facades\NotificationFacade;
use Modules\Otp\Facades\OtpServiceFacades;
use Modules\User\Models\User;
use Tests\TestCase;

class AuthenticateOtpControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_login_otp_form()
    {
        $this->get(route('front.otp.showLoginForm'))
            ->assertViewIs('Otp::login');
    }

    public function test_request_otp()
    {
        NotificationFacade::shouldReceive('send')->once()->andReturnTrue();
        $phone_number = '09121001010';
        $this->postJson(route('front.otp.request'), ['phone_number' => $phone_number])
            ->assertRedirect(route('front.otp.showConfirmForm'));

        $this->assertDatabaseCount('otps', 1);
        $this->assertDatabaseHas('otps', ['phone_number' => $phone_number]);
    }

    public function test_guest_user_can_see_show_confirm_form_with_session_phone_number()
    {
        $this->session(['phone_number' => '09101001010'])
            ->get(route('front.otp.showConfirmForm'))
            ->assertViewIs('Otp::confirm');
    }

    public function test_guest_user_can_not_see_show_confirm_form_without_session_phone_number()
    {
        $this->get(route('front.otp.showConfirmForm'))
            ->assertRedirect(route('front.otp.showLoginForm'));
    }

    public function test_guest_user_can_confirm_otp_and_login_user()
    {
        $phone_number = '09121001010';
        $otp = OtpServiceFacades::requestOtp($phone_number);

        $response = $this->postJson(route('front.otp.confirm'), [
            'phone_number' => $otp->phone_number,
            'code' => $otp->code,
        ]);

        $response->assertRedirect(route('front.otp.showRegisterCompletionForm'));
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['mobile' => $phone_number]);
    }

    public function test_guest_user_can_not_confirm_otp_when_code_is_wrong()
    {
        $phone_number = '09121001010';
        $otp = OtpServiceFacades::requestOtp($phone_number);
        $wrongCode = 123456;

        $response = $this->postJson(route('front.otp.confirm'), [
            'phone_number' => $otp->phone_number,
            'code' => $wrongCode,
        ]);

        $response->assertRedirect()->assertSessionHasErrors(['code' => 'کد وارد شده نامعتبر می باشد']);
        $this->assertGuest();

        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseMissing('users', ['mobile' => $phone_number]);
    }

    public function test_guest_user_can_not_confirm_otp_when_otp_not_found()
    {
        $phone_number = '09121001010';
        $otp = OtpServiceFacades::requestOtp($phone_number);
        $wrongNumber = '09102002020';

        $response = $this->postJson(route('front.otp.confirm'), [
            'phone_number' => $wrongNumber,
            'code' => $otp->code,
        ]);

        $response->assertRedirect()->assertSessionHasErrors(['code' => 'کد وارد شده نامعتبر می باشد']);
        $this->assertGuest();

        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseMissing('users', ['mobile' => $phone_number]);
    }

    public function test_auth_user_can_see_show_register_completion_form_with_session_phone_number()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->session(['phone_number' => '09101001010'])
            ->get(route('front.otp.showRegisterCompletionForm'))
            ->assertViewIs('Otp::register-completion');
    }

    public function test_auth_user_can_not_see_show_register_completion_form_without_session_phone_number()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('front.otp.showRegisterCompletionForm'))
            ->assertRedirect(route('front.otp.showLoginForm'));
    }

    public function test_auth_user_can_complete_register()
    {
        $data = User::factory()->make()->toArray();

        $user = User::create(['mobile' => '09101001010']);
        $response = $this->actingAs($user)->post(route('front.otp.registerCompletion'), [
            'phone_number' => $user->mobile,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);

        $response->assertRedirect(route('front.home'));

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email']]);
    }

    public function test_auth_user_can_not_complete_register()
    {
        $data = User::factory()->make()->toArray();

        $user = User::create(['mobile' => '09101001010']);
        $wrongMobile = '09102002020';
        $response = $this->actingAs($user)->post(route('front.otp.registerCompletion'), [
            'phone_number' => $wrongMobile,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);

        $response->assertRedirect(route('front.otp.showLoginForm'));

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseMissing('users', ['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email']]);
    }

}
