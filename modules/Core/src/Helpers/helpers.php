<?php


if (!function_exists('getJalaliDate')) {
    function getJalaliDate($date, $format = 'Y-m-d H:i', $showDate = null)
    {
        $dateFormat = is_null($showDate) ? config('core.show-date') : $showDate;
        if (!($date instanceof DateTime)){
            return '-';
        }

        if ($dateFormat == 'carbon') {
            return \Morilog\Jalali\Jalalian::fromCarbon($date)->format($format);
        }
        return $date->diffForHumans();

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

}

