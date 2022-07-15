<?php

namespace Modules\Payment\Services;

use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\TransactionRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Transaction;

class Payment
{
    public function generate($amounts)
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $cartItems = CartService::getItems();

        $order = $orderRepo->store($this->orderData($amounts));
        if ($order) {
            $orderRepo->storeOrderItems($order->id , $cartItems);
            $this->completeTheTransactionProcess($order, $amounts);
        }
        $gateway = resolve(Gateway::class);
        $gateway->redirect();
    }

    private function completeTheTransactionProcess($order, $amounts)
    {
        $transactionRepo = resolve(TransactionRepositoryInterface::class);
        $gateway = resolve(Gateway::class);
        $token = $gateway->request($amounts['paying_amount'], 'پرداخت سفارش');
       $transactionRepo->store($this->transactionData($order , $amounts , $token));
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

    private function transactionData($order , $amounts , $token)
    {
        //todo gateway name
        return [
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'amount' => $amounts['paying_amount'],
            'token' => $token,
            'gateway_name' => 'pay',
            'description' => null,
            'status' => Transaction::STATUS_PENDING,
        ];
    }

}
