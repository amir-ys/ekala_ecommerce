<?php

namespace Modules\Front\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (self::checkUserInfo()) {
            return redirect()->route('front.checkout.profile.complete.page');
        }
        return $next($request);
    }

    public static function checkUserInfo()
    {
        if (empty(auth()->user()->first_name)
            || empty(auth()->user()->last_name)
            || empty(auth()->user()->mobile)
            || empty(auth()->user()->email)
        ) {
            return true;
        }
    }
}
