<?php


use Illuminate\Support\Carbon;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

if (!function_exists('getJalaliDate')) {
    function getJalaliDate($date, $format = 'Y-m-d H:i', $showDate = null)
    {
        if (is_null($date)) return null;
        if (!$showDate){
            $dateFormat =  config('core.show-date');
            if ($dateFormat == 'carbon') {
                return Jalalian::fromCarbon($date)->format($format);
            }
            return $date->diffForHumans();
        }

        return Jalalian::fromCarbon(Carbon::createFromFormat($format ,$date))->format($showDate);
    }
}

if (!function_exists('newFeedback')) {
    function newFeedback($title = 'موفقیت آمیز', $body = "عملیات با موفقیت انجام شد.", $type = 'success')
    {
        $session = session()->has('newFeedback') ? session()->get('newFeedback') : [];
        $session[] = ['title' => $title, 'body' => $body, 'type' => $type];
        session()->flash('newFeedback', $session);
    }
}


if (!function_exists('getDiscountAmount')) {
    function getDiscountAmount()
    {
        $discountAmount = 0;
        foreach (\Cart::getContent() as $cartItem) {
            $discountAmount += $cartItem->associatedModel->discountAmount() * $cartItem->quantity;
        }
        return $discountAmount;
    }

    //todo temprary
    if (!function_exists('coupon')) {
        function coupon($key = 'amount')
        {
            if (!Session()->has('coupon')) {
                return null;
            }
            if ($key == 'amount') {
                return session()->get('coupon')['amount'];
            }

            if ($key == 'id') {
                dd(session()->get('coupon')['nxc']);
                return session()->get('coupon')['coupon_id'] ?? null;

            }
        }
    }

    if (!function_exists('site_name')) {
        function site_name()
        {
            $site = \Modules\Setting\Models\Setting::query()->where('name', 'shop-name')->first();
            return $site ? $site->value : 'نا مشخص';
        }
    }
}

if (!function_exists('convertJalaliToDate')) {

    function convertJalaliToDate($date, $format = 'Y/m/d'): string
    {
        $dateString = CalendarUtils::convertNumbers($date, true);
        return CalendarUtils::createCarbonFromFormat($format, $dateString)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('getJalaliFromFormat')) {
    function getJalaliFromFormat($date, $format = null, $outputFormat = null)
    {
        $format = $format ?: 'Y-m-d H:i:s';
        $outputFormat = $outputFormat ?: 'Y/m/d';
        return Jalalian::fromCarbon(Carbon::createFromFormat($format ,$date))->format($outputFormat ?: $format);
    }
}

if (!function_exists('getJalaliFromCarbon')) {
    function getJalaliFromCarbon(Carbon $date)
    {
        return Jalalian::fromCarbon($date);
    }
}
