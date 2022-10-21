<?php

namespace Modules\RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RolePermissions\Database\Factories\PermissionFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    public static function factory(): PermissionFactory
    {
        return new PermissionFactory();
    }

    const PERMISSION_SUPER_ADMIN = 'super_admin';

    const PERMISSION_MANAGE_ATTRIBUTES = 'manage attributes';
    const PERMISSION_READ_ATTRIBUTES = 'read attributes';
    const PERMISSION_MANAGE_ATTRIBUTE_GROUPS = 'manage attribute_groups';
    const PERMISSION_READ_ATTRIBUTE_GROUPS = 'read attribute_groups';
    const PERMISSION_MANAGE_BRANDS = 'manage brands';
    const PERMISSION_READ_BRANDS = 'read brands';
    const PERMISSION_MANAGE_CATEGORIES = 'manage categories';
    const PERMISSION_READ_CATEGORIES = 'read categories';
    const PERMISSION_MANAGE_COMMENTS = 'manage comments';
    const PERMISSION_READ_COMMENTS = 'read comments';
    const PERMISSION_MANAGE_COUPONS = 'manage coupons ';
    const PERMISSION_READ_COUPONS = 'read coupons ';
    const PERMISSION_MANAGE_PAYMENTS = 'manage payments';
    const PERMISSION_READ_PAYMENTS = 'read payments';
    const PERMISSION_MANAGE_PRODUCTS = 'manage products';
    const PERMISSION_READ_PRODUCTS = 'read products';
    const PERMISSION_MANAGE_SETTINGS = 'manage settings';
    const PERMISSION_READ_SETTINGS = 'read settings';
    const PERMISSION_MANAGE_SLIDES = 'manage slides';
    const PERMISSION_READ_SLIDES = 'read slides';
    const PERMISSION_MANAGE_USERS = 'manage users';
    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage role_permissions';
    const PERMISSION_READ_USERS = 'read users';
    const PERMISSION_READ_ROLE_PERMISSIONS = 'read role_permissions';
    const PERMISSION_MANAGE_BLOG = 'manage blog';
    const PERMISSION_READ_BLOG = 'read blog';

    public static array $permissions = [
        self::PERMISSION_SUPER_ADMIN ,
        self::PERMISSION_MANAGE_ATTRIBUTES, self::PERMISSION_READ_ATTRIBUTES,
        self::PERMISSION_MANAGE_ATTRIBUTE_GROUPS, self::PERMISSION_READ_ATTRIBUTE_GROUPS,
        self::PERMISSION_MANAGE_BRANDS, self::PERMISSION_READ_BRANDS,
        self::PERMISSION_MANAGE_CATEGORIES, self::PERMISSION_READ_CATEGORIES,
        self::PERMISSION_MANAGE_COMMENTS, self::PERMISSION_READ_COMMENTS,
        self::PERMISSION_MANAGE_COUPONS, self::PERMISSION_READ_COUPONS,
        self::PERMISSION_MANAGE_PAYMENTS, self::PERMISSION_READ_PAYMENTS,
        self::PERMISSION_MANAGE_PRODUCTS, self::PERMISSION_READ_PRODUCTS,
        self::PERMISSION_MANAGE_SETTINGS, self::PERMISSION_READ_SETTINGS,
        self::PERMISSION_MANAGE_SLIDES, self::PERMISSION_READ_SLIDES,
        self::PERMISSION_MANAGE_USERS, self::PERMISSION_READ_USERS,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS, self::PERMISSION_READ_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_BLOG, self::PERMISSION_READ_BLOG,
    ];
}
