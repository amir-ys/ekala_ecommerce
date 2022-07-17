<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Models\Order;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Models\User;

class UserRepo extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;


    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update(int $id, array $data)
    {
        $this->query->findOrFail($id)->update([
            'username' => $data['username'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => !isset($data['password']) ?: bcrypt($data['password'])  ,
            'profile' => $data['uploadedProfile'],
            'email_verified_at' => isset($data['verify_email']) ? now() : null ,
            'status' => $data['status'],
        ]);
    }

    public function getUserOrders(int $id , $status)
    {
        $model = $this->query->where('id' , $id)->first();
        $query =  $model->orders()->with('items.product');
        if (!is_null($status)){
            $query = $this->whenStatus($query, $status , Order::STATUS_PENDING);
            $query = $this->whenStatus($query, $status , Order::STATUS_PAID);
            $query = $this->whenStatus($query, $status , Order::STATUS_POSTED);
            $query = $this->whenStatus($query, $status , Order::STATUS_FAILED);
        }
      return  $query = $query->get();
    }

    public function whenStatus($query ,  $request, $status)
    {
       return $query->when($request == $status, function ($q) use($status){
            $q->where('status', $status);
        });
    }
}
