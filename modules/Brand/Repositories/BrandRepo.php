<?php

namespace Modules\Brand\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Brand\Models\Brand;
use Modules\Core\Repositories\BaseRepository;

class BrandRepo implements BrandRepositoryInterface
{
    use BaseRepository;
    private $query;
    public function __construct()
    {
        $this->query = Brand::query();
    }

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

}
