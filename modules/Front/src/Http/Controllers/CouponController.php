<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Coupon\Contracts\CouponRepositoryInterface;
use Modules\Coupon\Models\Coupon;
use Modules\Front\Http\Requests\CouponCodeRequest;
use Modules\Payment\Contracts\OrderRepositoryInterface;

class CouponController extends Controller
{
    public function check(CouponCodeRequest $request)
    {
        $coupon = $this->checkCouponExist($request->code);
        $couponInfo = $this->getCouponInfo($coupon);
        $this->storeCouponInSession($couponInfo);

        alert()->success('موفقیت آمیز', 'کد تخفیف با موفقیت اعمال شد.');
        return back();

    }

    private function checkCouponExist($code)
    {
        $couponRepo = resolve(CouponRepositoryInterface::class);
        $coupon = $couponRepo->checkIfExist($code);

        if (!$coupon) {
            alert()->error('ناموفق', 'کد تخفیف  صحیح نمی باشد.');
            back()->throwResponse();
        }

        if (!is_null($coupon->user_id)){
            $coupon = $couponRepo->checkIfExistForUser($code , \auth()->id());
        }

        if (!$coupon) {
            alert()->error('ناموفق', 'کد تخفیف  صحیح نمی باشد.');
            back()->throwResponse();
        }

        return $coupon;
    }

    public function getCouponInfo($coupon)
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $order =  $orderRepo->getLatestOrderWithoutCoupon(\auth()->id());

        if ($order){
            if ($coupon->type == Coupon::TYPE_PERCENT){
                $couponDiscountAmount = ($coupon->percent / 100) * $order->final_amount;

                if ($couponDiscountAmount > $coupon->discount_ceiling){
                    $couponDiscountAmount = $coupon->discount_ceiling;
                }

            }elseif ($coupon->type == Coupon::TYPE_AMOUNT){
                $couponDiscountAmount = $coupon->amount;
            }

            $couponInfo = [
                'id' => $coupon->id ,
                'amount' => $couponDiscountAmount ,
                'code' => $coupon->code ,
                'final_amount' => $order->final_amount - $couponDiscountAmount ,
                'total_discount_amount' => $order->total_discount_amount + $couponDiscountAmount ,
            ];

             $orderRepo->updateOrderCouponDiscountInfo(\auth()->id() , $couponInfo);

             return $couponInfo;

        }else{
            alert()->error('ناموفق', 'شما سفارشی ندارید. یک سفارش ثبت کنید  ویا کد تخفیف از قبل اعمال شده است..');
            back()->throwResponse();        }
    }

    private function storeCouponInSession($couponInfo)
    {
        session()->put('coupon', ['code' => $couponInfo['code'], 'amount' => $couponInfo['amount'] , 'id' => $couponInfo['id'] ]);
    }

}
