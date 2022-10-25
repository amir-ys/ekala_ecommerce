<?php

namespace Modules\AttributeGroup\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class AttributeGroupPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ATTRIBUTE_GROUPS);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_ATTRIBUTE_GROUPS
            , Permission::PERMISSION_READ_ATTRIBUTE_GROUPS);
    }
}
