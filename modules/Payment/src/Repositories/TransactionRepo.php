<?php

namespace Modules\Payment\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Contracts\TransactionRepositoryInterface;
use Modules\Payment\Models\Transaction;

class TransactionRepo extends BaseRepository implements TransactionRepositoryInterface
{
    protected string $model = Transaction::class;
    public function store(array $data)
    {
        $this->query->create($data);
    }

    public function update(int $id, array $data)
    {
    }

    public function findByToken($token)
    {
       return $this->query->where('token' ,$token)->first();
    }

    public function changeStatus($id , $status)
    {
        $model = $this->findById($id);
        $model->update([
            'status' => $status
        ]);
    }

}
