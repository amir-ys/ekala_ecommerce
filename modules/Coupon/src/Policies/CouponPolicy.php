<?php

namespace Modules\Coupon\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class CouponPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COUPONS);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(Permission::PERMISSION_MANAGE_COUPONS
            , Permission::PERMISSION_READ_COUPONS);
    }
}
