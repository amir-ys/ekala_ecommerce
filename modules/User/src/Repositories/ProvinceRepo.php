<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\User\Models\Province;

class ProvinceRepo extends BaseRepository implements ProductRepositoryInterface
{
    protected $model = Province::class;

    public function getAll(): array|Collection
    {
       return $this->query->get();
    }
}
