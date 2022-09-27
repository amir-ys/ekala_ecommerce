<?php

namespace Modules\Payment\Services;

use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Order;

class PaymentService
{

    public function saveAddressAndDelivery($userId): void
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $orderRepo->saveAddressAndDelivery(auth()->id(), request()->all());
    }

    public function saveOrderAmounts($userId): void
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $data = $this->getCalculatedPrice();
        $orderRepo->saveOrderAmounts($userId, $data);
    }

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

//    private function completeThePaymentProcess($order, $amounts)
//    {
//        $paymentRepo = resolve(PaymentRepositoryInterface::class);
//        $gateway = resolve(Gateway::class);
//        $token = $gateway->request($amounts['paying_amount'], 'پرداخت سفارش');
//        $paymentRepo->store($this->paymentData($order, $amounts, $token, $gateway->getName()));
//    }

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
            'payment_type' => \Modules\Payment\Models\Payment::PAYMENT_TYPE_ONLINE,
        ];
    }

//    private function paymentData($order, $amounts, $token, $gatewayName)
//    {
//        //todo gateway name
//        return [
//            'user_id' => auth()->id(),
//            'order_id' => $order->id,
//            'amount' => $amounts['paying_amount'],
//            'token' => $token,
//            'gateway_name' => $gatewayName,
//            'payment_type' => \Modules\Payment\Models\Payment::PAYMENT_TYPE_ONLINE,
//            'status' => \Modules\Payment\Models\Payment::STATUS_PENDING,
//        ];
//    }


    public function getCalculatedPrice(): array
    {
        $finalPrice = CartService::getFinalAmount();
        $commonDiscount = $this->calcCommonDiscount($finalPrice);
        $discountAmount = getDiscountAmount();
        return [
            'discount_amount' => $discountAmount,
            'common_discount_id' => $commonDiscount['common_discount_id'],
            'common_discount_amount' => $commonDiscount['common_discount_amount'],
            'final_amount' => $commonDiscount['final_price'],
            'total_discount_amount' => $discountAmount + $commonDiscount['common_discount_amount'],
        ];

    }

    private function calcCommonDiscount($finalPrice): array
    {
        $commonDiscount = resolve(CommonDiscountRepositoryInterface::class)->findTheFirstDiscount();
        if ($commonDiscount) {
            $commonDiscountId = $commonDiscount->id;
            $commonDiscountAmount = ($commonDiscount->percent * $finalPrice) / 100;

            if ($commonDiscountAmount >= $commonDiscount->discount_ceiling) {
                $commonDiscountAmount = $commonDiscount->discount_ceiling;
            }

            if ((empty($commonDiscount->minimal_order_amount)) || ($finalPrice >= $commonDiscount->minimal_order_amount)) {
                $finalPrice = $finalPrice - $commonDiscountAmount;
            }else{
                $commonDiscountAmount = 0;
            }

        } else {
            $commonDiscountId = null;
            $commonDiscountAmount = null;
        }

        return [
            'common_discount' => $commonDiscountId,
            'common_discount_id' => $commonDiscountId,
            'common_discount_amount' => $commonDiscountAmount,
            'final_price' => $finalPrice,
        ];

    }

}
