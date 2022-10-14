<?php

namespace Modules\User\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id,array $data);
}
