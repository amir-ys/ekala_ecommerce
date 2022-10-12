<?php

namespace Modules\Payment\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;

class OrderRepo extends BaseRepository implements OrderRepositoryInterface
{
    protected string $model = Order::class;

    public function store(array $data)
    {
        return $this->query->create($data);
    }

    public function storeOrderItems($id, $cartItems)
    {
        $order = $this->findById($id);
        foreach ($cartItems as $cartItem) {
            $order->items()->create(
                [
                    'product_id' => $cartItem->id,
                    'price' => $price = $cartItem->price,
                    'quantity' => $quantity = $cartItem->quantity,
                    'total' => $quantity * $price,
                ]
            );
        }
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function changeStatus($id, $status)
    {
        $model = $this->findById($id);
        $model->update([
            'status' => $status
        ]);
    }

    public function changeDeliveryStatus($id, $status)
    {
        $model = $this->findById($id);
        $model->update([
            'delivery_status' => $status
        ]);
    }

    public function getSending(): array|Collection
    {
        return $this->getAllWhere('delivery_status', Order::DELIVERY_STATUS_SENDING);
    }

    public function getUnpaid(): array|Collection
    {
        return $this->query->whereHas('payment', function ($q){
            $q->where('status' , Payment::STATUS_PENDING)
                ->orWhere('status' , Payment::STATUS_PENDING_APPROVAL);
        })->get();
    }

    public function getCanceled(): array|Collection
    {
        return $this->getAllWhere('status', Order::STATUS_CANCELED);
    }

    public function getReturned(): array|Collection
    {
        return $this->getAllWhere('status', Order::STATUS_RETURNED);
    }

    public function getAllWhere($column, $value): array|Collection
    {
        return $this->query->where($column, $value)->get();
    }

    public function getItems($id)
    {
        $model = $this->findById($id);
        return $model->items()->with('product')->get();
    }

    public function saveAddress($userId, $data)
    {
        return $this->query->updateOrCreate(
            [
                'user_id' => $userId,
                'status' => Order::STATUS_PENDING
            ],
            [
                'user_address_id' => $data['address_id'] ,
            ]);
    }

    public function saveOrderAmounts($data)
    {
        $this->query->updateOrCreate(
            [
                'user_id' => $data['user_id'],
                'status' => Order::STATUS_PENDING
            ],
            [
                'discount_amount' => $data['discount_amount'],
                'common_discount_id' => $data['common_discount_id'],
                'common_discount_amount' => $data['common_discount_amount'],
                'final_amount' => $data['final_amount'],
                'total_discount_amount' => $data['total_discount_amount'],
            ]);

    }

    public function saveOrderItemsAmounts($data)
    {
        $order = $this->query->where('id' , $data['order_id'])->first();
        foreach ($data['cart'] as $item) {
            $order->items()->updateOrCreate(
                [
                    'order_id' => $data['order_id'],
                    'price' => $price = $item->attributes['price_with_discount'] ,
                    'quantity' => $quantity = $item->quantity ,
                    'total' => $price * $quantity ,
                    'product_id' => $item->associatedModel->id ,
                    'color_id' => $item->attributes['color']['id'] ,
                    'warranty_id' => $item->attributes['warranty']['id'] ,
                ],
                [
                    'price' =>  $item->attributes['price_with_discount'] ,
                    'quantity' =>  $item->quantity ,
                    'total' => $price * $quantity ,
                    'product_id' => $item->associatedModel->id ,
                    'color_id' => $item->attributes['color']['id'] ,
                    'warranty_id' => $item->attributes['warranty']['id'] ,

                ]);
        }
    }

    public function getCurrentOrder($userId)
    {
        return $this->query->where([
            ['user_id' ,  $userId,] ,
            ['status' , Order::STATUS_PENDING] ,
        ])->first();
    }

    public function getLatestOrderWithoutCoupon($userId)
    {
       return $this->query->where([
           ['user_id' ,  $userId,] ,
           ['status' , Order::STATUS_PENDING] ,
           [ 'coupon_id' , null] ,
       ])->first();
    }

    public function updateOrderCouponDiscountInfo($userId , $data)
    {
        $order = $this->getLatestOrderWithoutCoupon($userId);
        $order->update([
            'coupon_id' => $data['id'] ,
            'coupon_discount_amount' => $data['amount'] ,
            'final_amount' => $data['final_amount'] ,
            'total_discount_amount' => $data['total_discount_amount'] ,
        ]);
    }

    public function removeAllBeforeCouponAmountInCurrentOrder($userId)
    {
        return $this->query->where([
            ['user_id' ,  $userId,] ,
            ['status' , Order::STATUS_PENDING] ,
        ])->update([
            'coupon_id' =>  null ,
            'coupon_discount_amount' =>  null ,
         ]);
     }

    public function savePaymentId($userId , $paymentId)
    {
        $model = $this->getCurrentOrder($userId);
        $model->update([
           'payment_id' =>  $paymentId
        ]);
     }
}
