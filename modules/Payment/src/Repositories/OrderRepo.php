<?php

    namespace Modules\Payment\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Models\Order;

class OrderRepo extends BaseRepository implements OrderRepositoryInterface
{
    protected string $model = Order::class;
    public function store(array $data)
    {
       return $this->query->create($data);
    }

    public function storeOrderItems($orderId ,$cartItems)
    {
        $order = $this->findById($orderId);
        foreach ($cartItems as $cartItem){
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

    public function changeStatus($id , $status)
    {
        $model = $this->findById($id);
        $model->update([
           'status' => $status
        ]);
    }
}
