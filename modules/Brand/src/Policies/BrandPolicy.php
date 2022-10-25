<?php

namespace Modules\Brand\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class BrandPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_BRANDS);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_BRANDS
            , Permission::PERMISSION_READ_BRANDS);
    }
}
