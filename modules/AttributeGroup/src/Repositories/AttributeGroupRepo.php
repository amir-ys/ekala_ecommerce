<?php

namespace Modules\AttributeGroup\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Brand\Models\Brand;
use Modules\Core\Repositories\BaseRepository;

class AttributeGroupRepo extends BaseRepository implements AttributeGroupRepositoryInterface
{
    protected $model = AttributeGroup::class;

    public function getAllPaginate(): Paginator|LengthAwarePaginator
    {
      return $this->query->with('category')->latest()->paginate();
    }
    public function store(array $data)
    {
        $this->query->create([
            'name' => $data['name'] ,
            'category_id' => $data['category_id'] ,
        ]);
    }

    public function update(int $id, array $data)
    {
        $brand = $this->findById($id);
         $brand->update([
            'name' => $data['name'] ,
             'category_id' => $data['category_id'] ,
         ]);
    }

    public function all(): array|Collection
    {
       return $this->query->get();
    }

    public function checkHasCategory($id)
    {
       return $this->query->where('category_id' , $id)->first();
    }
}
