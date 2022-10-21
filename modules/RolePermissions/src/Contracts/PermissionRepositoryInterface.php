<?php
namespace Modules\RolePermissions\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
