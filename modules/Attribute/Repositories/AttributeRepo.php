<?php

namespace Modules\Attribute\Repositories;

use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;

class AttributeRepo extends BaseRepository implements AttributeRepositoryInterface
{
    protected string $model = Attribute::class;
    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
}
