<?php

namespace Modules\AttributeGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\AttributeGroup\Database\Factories\AttributeGroupFactory;

class AttributeGroup extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public static function newFactory()
    {
        return new  AttributeGroupFactory();
    }
}
