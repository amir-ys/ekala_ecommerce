<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\Auth\EmailVerificationRequest;
use Modules\User\Services\EmailVerifyService;

class EmailVerificationController extends Controller
{
    public function showForm(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            redirect()->route('panel.home');
        }

        if (!EmailVerifyService::has(auth()->id())) {
            auth()->user()->sendEmailVerificationCode();
        }
        return view('User::auth.verify-email');
    }

    public function checkCode(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('panel.home');
        }

        if (!EmailVerifyService::check(auth()->user(), $request->code)) {
            return redirect()->back()->withErrors(['code' => 'کد فعال سازی نامعتبر است!'])->withInput();
        }

        auth()->user()->markEmailAsVerified();

        return redirect()->route(auth()->user()->panelPath());
    }

    public function resend()
    {
        auth()->user()->sendEmailVerificationCode();
        return redirect()->back()->with('success' , 'یک کد فعال سازی جدید برای شما ارسال شد.')->withInput();
    }
}
