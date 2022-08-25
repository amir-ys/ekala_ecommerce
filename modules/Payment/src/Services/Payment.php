<?php

namespace Modules\Payment\Services;

use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Order;

class Payment
{
    public function generate($amounts)
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $cartItems = CartService::getItems();

        $order = $orderRepo->store($this->orderData($amounts));
        if ($order) {
            $orderRepo->storeOrderItems($order->id, $cartItems);
            $this->completeThePaymentProcess($order, $amounts);
        }
        $gateway = resolve(Gateway::class);
        $gateway->redirect();
    }

    private function completeThePaymentProcess($order, $amounts)
    {
        $paymentRepo = resolve(PaymentRepositoryInterface::class);
        $gateway = resolve(Gateway::class);
        $token = $gateway->request($amounts['paying_amount'], 'پرداخت سفارش');
        $paymentRepo->store($this->paymentData($order, $amounts, $token, $gateway->getName()));
    }

    private function orderData($amounts)
    {
        //todo payment_type make dynamic
        //todo user addresses
        return [
            'user_id' => auth()->id(),
//            'user_address_id' => null,
            'coupon_id' => coupon('id'),
            'status' => Order::STATUS_PENDING,
            'total_amount' => $amounts['total_amount'],
            'coupon_amount' => $amounts['coupon_amount'],
            'paying_amount' => $amounts['paying_amount'],
            'payment_type' => 'pay',
        ];
    }

    private function paymentData($order, $amounts, $token, $gatewayName)
    {
        //todo gateway name
        return [
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'amount' => $amounts['paying_amount'],
            'token' => $token,
            'gateway_name' => $gatewayName,
            'payment_type' => \Modules\Payment\Models\Payment::PAYMENT_TYPE_ONLINE,
            'status' => \Modules\Payment\Models\Payment::STATUS_PENDING,
        ];
    }

}
