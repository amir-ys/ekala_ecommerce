<?php

namespace Modules\Product\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class ProductPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS)) {
            return true;
        }
        return false;
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_PRODUCTS
            , Permission::PERMISSION_READ_PRODUCTS);
    }
}
