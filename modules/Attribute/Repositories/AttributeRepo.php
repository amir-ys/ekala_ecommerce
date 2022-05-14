<?php

namespace Modules\Attribute\Repositories;

use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Models\Attribute;
use Modules\Core\Repositories\BaseRepository;

class AttributeRepo extends BaseRepository implements AttributeRepositoryInterface
{
    protected string $model = Attribute::class;
    public function store(array $data)
    {
        $this->query->create([
           'name' => $data['name'] ,
           'attribute_group_id' => $data['attribute_group_id'] ,
           'is_filterable' => $data['is_filterable'] ??  Attribute::FILTERABLE_FALSE ,
        ]);
    }

    public function update(int $id, array $data)
    {
        $model  = $this->query->findOrFail($id);
        $model->update([
            'name' => $data['name'] ,
            'attribute_group_id' => $data['attribute_group_id'] ,
            'is_filterable' => $data['is_filterable'] ??  Attribute::FILTERABLE_FALSE ,
        ]);    }
}
