<?php

namespace Modules\Payment\Repositories;

use Illuminate\Support\Carbon;
use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Models\Payment;

class PaymentRepo extends BaseRepository implements PaymentRepositoryInterface
{
    protected string $model = Payment::class;

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
        return $this->query->where('payment_type', $type)->with('user')->get();
    }

    public function storePayment($data)
    {
        return $this->query->updateOrCreate($data, []);
    }

    public function totalSalesForCurrentDay()
    {
        return $this->query->where('created_at' , today())->sum('amount');
    }

    public function totalSalesInThisYear()
    {
        $startOfThisYear = Carbon::now()->startOfYear();
        return $this->query->whereBetween('created_at' , [ $startOfThisYear , now()])->sum('amount');
    }

    public function totalSalesInThisMonth()
    {
        $startOfThisYear = Carbon::now()->startOfMonth();
        return $this->query->whereBetween('created_at' , [ $startOfThisYear , now()])->sum('amount');
    }

}
