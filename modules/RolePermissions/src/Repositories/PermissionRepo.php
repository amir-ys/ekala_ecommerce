<?php

namespace Modules\RolePermissions\Repositories;


use Modules\Core\Repositories\BaseRepository;
use Modules\RolePermissions\Contracts\PermissionRepositoryInterface;
use Modules\RolePermissions\Models\Permission;

class PermissionRepo extends BaseRepository implements PermissionRepositoryInterface
{
    protected string $model = Permission::class;
}
