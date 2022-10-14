<?php

namespace Modules\Brand\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface BrandRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id,array $data);
}
