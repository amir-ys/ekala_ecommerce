<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Front\Services\CartService;
use Modules\Payment\Facades\PaymentService;

class OrderController extends Controller
{
    public function generate()
    {
        $amounts = $this->getAmounts();
        PaymentService::generate($amounts);
    }

    private function getAmounts()
    {
        return [
            'total_amount' => $total_amount = CartService::getTotal(),
            'coupon_amount' => coupon() == null ? 0 : coupon(),
            'paying_amount' => $total_amount - coupon(),
        ];
    }

}
