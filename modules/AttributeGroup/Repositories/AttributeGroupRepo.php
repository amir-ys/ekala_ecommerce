<?php

namespace Modules\AttributeGroup\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Brand\Models\Brand;
use Modules\Core\Repositories\BaseRepository;

class AttributeGroupRepo extends BaseRepository implements AttributeGroupRepositoryInterface
{
    protected $model = AttributeGroup::class;
    public function store(array $data)
    {
        $this->query->create([
            'name' => $data['name'] ,
        ]);
    }

    public function update(int $id, array $data)
    {
        $brand = $this->findById($id);
         $brand->update([
            'name' => $data['name'] ,
        ]);
    }
}
