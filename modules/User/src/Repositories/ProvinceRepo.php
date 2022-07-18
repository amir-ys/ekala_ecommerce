<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\BaseRepository;
use Modules\User\Models\Province;

class ProvinceRepo extends BaseRepository
{
    protected $model = Province::class;

    public function getAll(): array|Collection
    {
       return $this->query->get();
    }
}
