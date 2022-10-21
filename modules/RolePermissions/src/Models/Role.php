<?php
namespace Modules\RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RolePermissions\Database\Factories\RoleFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        self::deleting(function ($role){
            $role->permissions()->sync([]);
        });
    }

    public static function factory(): RoleFactory
    {
        return new RoleFactory();
    }

}
