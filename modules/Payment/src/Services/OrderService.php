<?php

namespace Modules\Payment\Services;

use Modules\Cart\Facades\CartServiceFacade;
use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Payment\Contracts\OrderRepositoryInterface;

class OrderService
{
    public $orderRepo;
    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function saveAddress($userId , $data): void
    {
        $this->orderRepo->saveAddress(auth()->id(), $data);
    }

    public function saveOrderAndOrderItems($userId): void
    {
        //save order
        $orderData = $this->getOrderData();
        $this->orderRepo->saveOrderAmounts($orderData);

        //save order items
        $order = $this->orderRepo->getCurrentOrder(auth()->id());
        $orderItemsData = $this->getOrderItemsData($order);
        $this->orderRepo->saveOrderItemsAmounts($orderItemsData);
    }

    private function getOrderData(): array
    {
        $finalPrice = getFinalAmount();
        $discountAmount = getDiscountAmount();
        $commonDiscount = $this->calcCommonDiscount($finalPrice);
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
            'cart' => CartServiceFacade::getItems()
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
