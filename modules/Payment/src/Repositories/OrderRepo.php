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
        return $this->query->whereRelation('payment', 'status', Payment::STATUS_SUCCESS)->get();
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

    public function saveAddressAndDelivery($userId, $data)
    {
        $model = $this->query->updateOrCreate(
            [
                'user_id' => $userId,
                'status' => Order::STATUS_PENDING
            ],
            [
                'user_address_id' => $data['address_id'] ,
                'delivery_id' => $data['delivery_id'] ,
            ]);


       $model->final_amount +=  $data['delivery_amount'];
       $model->save();
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
        //todo save itmes
        foreach ($data as $item) {
            $this->query->updateOrCreate(
                [
                    'order_id' => $data['order_id'],
                ],
                [
                    'product_id' => $item->associatedModel->id ,
                    'price' => $item->attributes[''] ,
                    'quantity' => $item->attributes[''] ,

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
}
