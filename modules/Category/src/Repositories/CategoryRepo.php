<?php

namespace Modules\Category\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Category\Enums\CategoryStatus;
use Modules\Category\Models\Category;
use Modules\Core\Repositories\BaseRepository;

class CategoryRepo extends BaseRepository  implements CategoryRepositoryInterface
{
    protected $model = Category::class;

    public function getAll()
    {
        return $this->query->latest()->with('parent')->get();
    }
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
        $model = $this->findById($id);
        $model->update([
            'name' => $data['name'] ,
            'parent_id' => $data['parent_id'] ,
            'is_active' => $data['is_active'] ,
            'is_searchable' => $data['is_searchable'] ?? Category::SEARCHABLE_FALSE
        ]);
    }

    public function getParentCategories(): Collection|array
    {
       return $this->query->whereNull('parent_id')->get();
    }

    public function getParentCategoriesExceptId($id)
    {
        return $this->query->whereNull('parent_id')->get()->
        filter(function ($cat) use ($id) {
            return $cat->id != $id;
        });
    }

    public function checkHasChildes($id)
    {
      return  $this->query->where('parent_id' , $id)->first();
    }

    public function all(): array|Collection
    {
        return $this->query->get();
    }

    public function allParent(): array|Collection
    {
        return $this->query
            ->where('parent_id' , null)
            ->where('is_active' , CategoryStatus::ACTIVE->value)
            ->with('childes')->get();
    }

    public function detachAttributeGroupFromCategory($id)
    {
        $category = $this->findById($id);
        $category->attributeGroups()->detach();
    }

    public function findBySlug($categorySlug)
    {
        return  $this->query
            ->where('is_active' , CategoryStatus::ACTIVE->value)
            ->where('slug' , $categorySlug)
            ->firstOrFail();
    }
}
