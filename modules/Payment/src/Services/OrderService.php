<?php

namespace Modules\Payment\Services;

use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Product\Contracts\DeliveryRepositoryInterface;

class OrderService
{

    public function saveAddressAndDelivery($userId): void
    {
        $data = request()->all();
        $data['delivery_amount'] = resolve(DeliveryRepositoryInterface::class)->getAmount(request('delivery_id'));
         resolve(OrderRepositoryInterface::class)->saveAddressAndDelivery(auth()->id(), $data);
    }


    public function saveOrderAndOrderItems($userId): void
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);

        $orderData = $this->getOrderData();
        $orderRepo->saveOrderAmounts($orderData);

        $order = $orderRepo->getCurrentOrder();
        $orderItemsData = $this->getOrderItemsData($order);
        $orderRepo->saveOrderItemsAmounts($orderItemsData);
    }

    private function getOrderData(): array
    {
        $finalPrice = CartService::getFinalAmount();
        $commonDiscount = $this->calcCommonDiscount($finalPrice);
        $discountAmount = getDiscountAmount();
        return [
            'user_id' => auth()->id() ,
            'discount_amount' => $discountAmount,
            'common_discount_id' => $commonDiscount['common_discount_id'],
            'common_discount_amount' => $commonDiscount['common_discount_amount'],
            'final_amount' => $commonDiscount['final_price'],
            'total_discount_amount' => $discountAmount + $commonDiscount['common_discount_amount'],
        ];

    }

    private function getOrderItemsData($order)
    {
        return [
            'order_id' => $order->id ,
            'cart' => CartService::getItems()
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
            } else {
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
