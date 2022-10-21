<?php
namespace Modules\RolePermissions\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id , array $data);

}
