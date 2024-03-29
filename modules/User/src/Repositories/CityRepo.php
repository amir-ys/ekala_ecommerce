<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\BaseRepository;
use Modules\User\Contracts\CityRepositoryInterface;
use Modules\User\Models\City;

class CityRepo extends BaseRepository implements  CityRepositoryInterface
{
    protected $model = City::class;
    public function findByProvince($provinceId): array|Collection
    {
        return $this->query->where('province_id' , $provinceId )->get();
    }
}
