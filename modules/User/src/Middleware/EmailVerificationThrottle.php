<?php

namespace Modules\User\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationThrottle
{
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @return
     * void
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 3, $decaySeconds = 1800)
    {
        $executed = $this->limiter->attempt('email_verify_' . auth()->id(), $maxAttempts,
            function () {
            return;
            }, $decaySeconds);

        if (!$executed) {
            return  redirect()->route('verification.showForm')
                ->with('message' , 'تعداد درخواست شما بیش از حد مجاز بوده است. لطفا در زمانی دیگر درخواست خود را ارسال کنید.');
        }

        return $next($request);
    }
}
