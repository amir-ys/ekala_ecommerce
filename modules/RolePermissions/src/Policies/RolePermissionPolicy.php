<?php

namespace Modules\RolePermissions\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class RolePermissionPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS
            , Permission::PERMISSION_READ_ROLE_PERMISSIONS);
    }
}
