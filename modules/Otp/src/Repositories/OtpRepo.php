<?php

namespace Modules\Otp\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Otp\Contracts\OtpRepositoryInterface;
use Modules\Otp\Models\Otp;

class OtpRepo extends BaseRepository implements OtpRepositoryInterface
{
    protected string $model = Otp::class;

    public function findByPhoneNumber($phoneNumber)
    {
        return $this->query->where('phone_number', $phoneNumber)->first();
    }

    public function findByCode($code)
    {
        return $this->query->where('code', $code)->first();
    }

    public function store(array $data)
    {
        return $this->query->create($data);
    }

    public function destroyByPhoneNumber($phoneNumber)
    {
        return $this->query->where('phone_number', $phoneNumber)->delete();
    }

}
