<?php

if (!function_exists('coupon')) {
    function coupon($key = 'amount')
    {
        if (!Session()->has('coupon')) {
            return 0;
        }
        if ($key == 'amount') {
            return session()->get('coupon')['amount'];
        }

        if ($key == 'id') {
            return session()->get('coupon')['coupon_id'];
        }
    }
}
