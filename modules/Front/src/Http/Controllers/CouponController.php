<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Coupon\Contracts\CouponRepositoryInterface;
use Modules\Coupon\Models\Coupon;

class CouponController extends Controller
{
    public function check(Request $request)
    {
        $this->validateCoupon($request);
        $this->checkUserLoggedIn();
        $coupon = $this->checkCouponExist($request->code);

        #todo check coupon in order
        //...

        $this->storeCouponInSession($coupon);

        newFeedback('موفقیت آمیز', 'کد تخفیف با موفقیت اعمال شد.');
        return back();

    }

    private function validateCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
    }

    private function checkCouponExist($code)
    {
        $couponRepo = resolve(CouponRepositoryInterface::class);
        $coupon = $couponRepo->checkIfExist($code);
        if (!$coupon) {
            alert()->error('ناموفق', 'کد تخفیف  صحیح نمی باشد.');
            back()->throwResponse();
        }
        return $coupon;
    }

    private function checkUserLoggedIn()
    {
        if (!Auth::check()) {
            alert()->error('ناموفق', 'برای استفاده از کد تخفیف باید وارد سایت شوید.');
            back()->throwResponse();
        }
    }

    private function storeCouponInSession($coupon)
    {
        if ($coupon->type == Coupon::TYPE_AMOUNT) {
            session()->put('coupon', ['code' => $coupon->code, 'amount' => $coupon->amount , 'coupon_id' => $coupon->id]);
        } elseif ($coupon->type == Coupon::TYPE_PERCENT) {
            $total = \Cart::getTotal();
            $amount = (($total * $coupon->percent) / 100);
            session()->put('coupon', ['code' => $coupon->code, 'amount' => $amount , 'coupon_id' => $coupon->id]);
        }
    }

}
