<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Payment\Models\Order;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Models\User;
use Modules\User\Models\UserAddress;

class UserRepo extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;


    public function store(array $data)
    {
        $this->query->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile' => $data['uploadedProfile'],
            'email_verified_at' => isset($data['verify_email']) ? now() : null,
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $this->query->findOrFail($id)->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => !isset($data['password']) ?: bcrypt($data['password']),
            'profile' => $data['uploadedProfile'],
            'email_verified_at' => isset($data['verify_email']) ? now() : null,
            'status' => $data['status'],
        ]);
    }

    public function getUserOrders(int $id, $status)
    {
        $model = $this->query->where('id', $id)->first();
        $query = $model->orders()->with('items.product');
        if (!is_null($status)) {
            $query = $this->whenStatus($query, $status, Order::STATUS_PENDING);
            $query = $this->whenStatus($query, $status, Order::STATUS_PAID);
            $query = $this->whenStatus($query, $status, Order::STATUS_POSTED);
            $query = $this->whenStatus($query, $status, Order::STATUS_FAILED);
        }
        return $query->get();
    }

    public function storeUserAddress($id, $data)
    {
        $model = $this->query->find($id);
        $model->addresses()->create([
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'address' => $data['address'],
            'receiver' => $data['receiver'],
            'postal_code' => $data['postal_code'],
            'phone_number' => $data['phone_number'],
        ]);
    }

    public function getAddresses($id)
    {
        $model = $this->query->findOrFail($id);
        return $model->addresses()->with(['province', 'city'])->get();
    }

    public function deleteUserAddress($id, $userAddressesId)
    {
        $model = $this->query->find($id);
        $model->addresses()->where('id', $userAddressesId)->delete();
    }

    public function changeUserAddressStatus($id, $userAddressesId, $status)
    {
        $model = $this->query->find($id);
        $model->addresses()->update(['is_active' => UserAddress::STATUS_INACTIVE]);
        $model->addresses()->where('id', $userAddressesId)->update(['is_active' => $status]);
    }

    public function findAddressById($id, $addressId)
    {
        $model = $this->query->find($id);
        return $model->addresses()->where('id', $addressId)->first();
    }


    private function whenStatus($query, $request, $status)
    {
        return $query->when($request == $status, function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    public function updateFields($id , $data)
    {
       return $this->query->where('id' , $id)->update($data);
    }

    public function getActiveAddresses($id)
    {
        $model = $this->query->where('id' , $id)->firstOrFail();
       return $model->addresses()->get();
    }
}
