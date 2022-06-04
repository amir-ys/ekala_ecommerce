<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{

    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('panel.home');
        }

        $request->user()->sendEmailVerificationNotification();

        return view('User::auth.verify-email');
    }
}
