<?php

namespace Modules\AttributeGroup\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Core\Repositories\BaseRepository;

class AttributeGroupRepo extends BaseRepository implements AttributeGroupRepositoryInterface
{
    protected $model = AttributeGroup::class;

    public function getAllPaginate(): Paginator|LengthAwarePaginator
    {
        return $this->query->with('categories')->latest()->paginate();
    }

    public function store(array $data)
    {
        $attributeGroup = $this->query->create([
            'name' => $data['name'],
        ]);
        $this->attachCategoryToAttributeGroup($attributeGroup, $data['category_ids']);
    }

    private function attachCategoryToAttributeGroup($attributeGroup, $categoryIds, $isEdit = false)
    {
        if ($isEdit) {
            $this->detachCategoryToAttributeGroup($attributeGroup);
        }
        $attributeGroup->categories()->attach($categoryIds);
    }

    public function detachCategoryToAttributeGroup($attributeGroup)
    {
        $attributeGroup->categories()->detach();
    }

    public function update(int $id, array $data)
    {
        $attributeGroup = $this->findById($id);
        $attributeGroup->update([
            'name' => $data['name'],
        ]);
        $this->attachCategoryToAttributeGroup($attributeGroup, $data['category_ids'], true);
    }

    public function destroy(int $id) :void
    {
        $attributeGroup = $this->findById($id);
        $this->detachCategoryToAttributeGroup($attributeGroup);
        $attributeGroup->delete();
    }

    public function all(): array|Collection
    {
        return $this->query->get();
    }

    public function checkHasCategory($id)
    {
        return $this->query->where('category_id', $id)->first();
    }
}
