<?php

namespace Modules\Front\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Front\Services\CartService;

class FillingCart
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (CartService::empty()) {
            alert()->error('ناموفق', 'سبد خرید شما خالی است.');
            return back();
        }
        return $next($request);
    }
}
