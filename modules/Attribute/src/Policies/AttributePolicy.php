<?php

namespace Modules\Attribute\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class AttributePolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ATTRIBUTES);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_ATTRIBUTES
            , Permission::PERMISSION_READ_ATTRIBUTES);
    }
}
