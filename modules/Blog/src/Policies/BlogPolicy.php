<?php

namespace Modules\Blog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class BlogPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_BLOG);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_BLOG
            , Permission::PERMISSION_READ_BLOG);
    }
}
