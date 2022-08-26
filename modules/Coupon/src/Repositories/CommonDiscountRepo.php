<?php

namespace Modules\Coupon\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Coupon\Models\CommonDiscount;

class CommonDiscountRepo extends BaseRepository implements CommonDiscountRepositoryInterface
{
    protected $model = CommonDiscount::class;


    public function store(array $data)
    {
        $this->query->create([
            'title' => $data['title'],
            'percent' => $data['percent'],
            'discount_ceiling' => $data['discount_ceiling'],
            'minimal_order_amount' => $data['minimal_order_amount'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);
        $model->update([
            'title' => $data['title'],
            'percent' => $data['percent'],
            'discount_ceiling' => $data['discount_ceiling'],
            'minimal_order_amount' => $data['minimal_order_amount'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
        ]);
    }

}
