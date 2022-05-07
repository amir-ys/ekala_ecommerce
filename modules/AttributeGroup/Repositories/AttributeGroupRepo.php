<?php

namespace Modules\AttributeGroup\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Brand\Models\Brand;

class AttributeGroupRepo implements AttributeGroupRepositoryInterface
{
    private $query;
    public function __construct()
    {
        $this->query = AttributeGroup::query();
    }

    public function getAllPaginate(): Paginator
    {
       return $this->query->latest()->paginate();
    }

    public function findById(int $id)
    {
       return $this->query->findOrFail($id);
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

    public function destroy(int $id)
    {
        $brand = $this->findById($id);
         $brand->delete();
    }
}
