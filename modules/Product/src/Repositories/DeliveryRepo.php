<?php

namespace Modules\Product\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Contracts\DeliveryRepositoryInterface;
use Modules\Product\Models\Delivery;

class DeliveryRepo extends BaseRepository implements DeliveryRepositoryInterface
{
    protected $model = Delivery::class;

    public function store(array $data)
    {
        return $this->query->create([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'delivery_unit' => $data['delivery_unit'],
            'delivery_time' => $data['delivery_time'],
            'status' => $data['status'],

        ]);
    }

    public function update(int $id, array $data)
    {
        return $this->query->where('id', $id)->update([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'delivery_unit' => $data['delivery_unit'],
            'delivery_time' => $data['delivery_time'],
            'status' => $data['status'],
        ]);
    }

    public function getActiveADelivery(): array|Collection
    {
       return $this->query->where('status' , Delivery::STATUS_ACTIVE)->get();
    }

}
