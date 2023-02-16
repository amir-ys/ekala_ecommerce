<?php

namespace Modules\Otp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Otp\Contracts\OtpRepositoryInterface;
use Modules\Otp\Facades\OtpServiceFacades;
use Modules\Otp\Http\Requests\ConfirmOtpRequest;
use Modules\Otp\Http\Requests\OtpRequest;
use Modules\Otp\Http\Requests\RegisterCompletionRequest;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Models\User;

class AuthenticateOtpController extends Controller
{
    public function showLoginForm(): View
    {
        return view('Otp::login');
    }

    public function requestOtp(OtpRequest $request): RedirectResponse
    {
        $otp = OtpServiceFacades::requestOtp($request->phone_number);

        #todo send otp to user
        Log::alert("send otp : $otp->code to user");

        return to_route('front.otp.showConfirmForm')->with('phone_number', $request->phone_number);
    }

    public function showConfirmForm()
    {
        if (session()->has('phone_number')) {
            session()->reflash();
            return view('Otp::confirm');
        }
        return to_route('front.otp.showLoginForm');
    }

    public function confirmOtp(ConfirmOtpRequest $request, UserRepositoryInterface $userRepo): RedirectResponse
    {
        session()->reflash();
        $phone_number = $request->phone_number;
        $otp = (resolve(OtpRepositoryInterface::class))->findByPhoneNumber($phone_number);
        if (!$otp) {
            return back()->withErrors(['code' => 'کد وارد شده نامعتبر می باشد']);
        }

        if ($request->code != $otp->code) {
            return back()->withErrors(['code' => 'کد وارد شده نامعتبر می باشد']);
        }

        $user = $userRepo->findByPhoneNumber($phone_number);
        if ($user) {
            $this->authHelper($user);
            return redirect()->route('front.home');
        }
        $user = $userRepo->storeWithSpecifiedData(['mobile' => $phone_number]);
        $this->authHelper($user);
        return redirect()->route('front.otp.showRegisterCompletionForm')->with('phone_number', $phone_number);

    }

    public function showRegisterCompletionForm(): View|RedirectResponse
    {
        if (session()->has('phone_number')) {
            session()->reflash();
            return view('Otp::register-completion');
        }
        return to_route('front.otp.showLoginForm');
    }

    public function registerCompletion(RegisterCompletionRequest $request, UserRepositoryInterface $userRepo): RedirectResponse
    {
        $phone_number = $request->phone_number;

        if (!$user = $userRepo->findByPhoneNumber($phone_number)) {
            alert()->warning('ناموفق', 'شما هنوز ثبت نام نکرده اید.');
            return to_route('front.otp.showLoginForm');
        }

        $userRepo->updateFields($user->id, $request->validated());
        return to_route('front.home');
    }

    private function authHelper(User $user)
    {
        resolve(UserRepositoryInterface::class)->change2FAEnableStatus($user->id, User::TWO_FACTOR_AUTH_ENABLE);;
        Auth::login($user);
    }
}
