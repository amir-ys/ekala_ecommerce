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
        $this->query->updateOrCreate(
            [
                'user_id' => $userId,
                'status' => Order::STATUS_PENDING
            ],
            [
                'user_address_id' => $data['address_id'] ,
                'delivery_id' => $data['delivery_id']
            ]);
    }
}
