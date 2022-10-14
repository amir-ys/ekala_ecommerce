<?php

namespace Modules\Attribute\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id,array $data);
}
