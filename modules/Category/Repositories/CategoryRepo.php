<?php

namespace Modules\Category\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Category\Models\Category;
use Modules\Core\Repositories\BaseRepository;

class CategoryRepo extends BaseRepository  implements CategoryRepositoryInterface
{
    protected $model = Category::class;
    public function store(array $data)
    {
        $this->query->create([
            'name' => $data['name'] ,
           'parent_id' => $data['parent_id'] ,
           'is_active' => $data['is_active'] ,
           'is_searchable' => $data['is_searchable'] ?? Category::SEARCHABLE_FALSE
        ]);
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function getParentCategories(): Collection|array
    {
       return $this->query->whereNull('parent_id')->get();
    }



}
