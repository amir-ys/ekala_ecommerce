<?php

namespace Modules\Brand\Repositories;

use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Brand\Enums\BrandStatus;
use Modules\Brand\Models\Brand;
use Modules\Core\Repositories\BaseRepository;

class BrandRepo extends BaseRepository implements BrandRepositoryInterface
{
    protected $model = Brand::class;
    public function store(array $data)
    {
        $this->query->create([
            'name' => $data['name'] ,
            'is_active' => $data['is_active']
        ]);
    }

    public function update(int $id, array $data)
    {
        $brand = $this->findById($id);
         $brand->update([
            'name' => $data['name'] ,
            'is_active' => $data['is_active']
        ]);
    }

    public function getActive(): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->query
            ->where('is_active' , BrandStatus::ACTIVE)
            ->get();
    }

    public function all()
    {
        return $this->query->get();
    }

}
