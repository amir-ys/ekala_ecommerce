<?php

namespace Modules\AttributeGroup\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface AttributeGroupRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();
    public function store(array $data);
    public function update(int $id,array $data);
}
