<?php

namespace Modules\Blog\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id,array $data);
}
