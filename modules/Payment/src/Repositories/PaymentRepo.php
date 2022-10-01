<?php

namespace Modules\Payment\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Models\Payment;

class PaymentRepo extends BaseRepository implements PaymentRepositoryInterface
{
    protected string $model = Payment::class;

    public function store(array $data)
    {
        $this->query->create($data);
    }


    //todo
    public function update(int $id, array $data)
    {
    }

    public function findByToken($token)
    {
        return $this->query->where('token', $token)->first();
    }

    public function changeStatus($id, $status)
    {
        $model = $this->findById($id);
        $model->update([
            'status' => $status
        ]);
    }

    public function getPaymentsByType($type)
    {
       return $this->query->where('payment_type' , $type)->with('user')->get();
    }

    public function storeOfflinePayment($data)
    {
        $this->query->updateOrCreate($data , []);
   }

}
