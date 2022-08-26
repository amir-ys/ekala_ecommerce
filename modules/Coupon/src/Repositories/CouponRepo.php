<?php

namespace Modules\Coupon\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Coupon\Contracts\CouponRepositoryInterface;
use Modules\Coupon\Models\Coupon;

class CouponRepo extends BaseRepository implements CouponRepositoryInterface
{
    protected $model = Coupon::class;


    public function store(array $data)
    {
        $this->query->create([
            'code' => $data['code'],
            'type' => $data['type'],
            'amount' => $data['amount'],
            'percent' => $data['percent'],
            'use_type' => $data['use_type'],
            'discount_ceiling' => $data['discount_ceiling'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);
        $model->update([
            'code' => $data['code'],
            'type' => $data['type'],
            'amount' => $data['amount'],
            'percent' => $data['percent'],
            'use_type' => $data['use_type'],
            'discount_ceiling' => $data['discount_ceiling'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
        ]);
    }

    public function checkIfExist($code)
    {
        return $this->query->where('code', $code)->where('expired_at', '>', now())->first();
    }
}
