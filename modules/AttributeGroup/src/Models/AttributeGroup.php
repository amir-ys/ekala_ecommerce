<?php

namespace Modules\AttributeGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Database\Factories\AttributeGroupFactory;
use Modules\Category\Models\Category;

class AttributeGroup extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public static function newFactory(): AttributeGroupFactory
    {
        return new  AttributeGroupFactory();
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class , 'attribute_group_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class , 'attribute_group_category','attribute_group_id' ,
            'category_id');
    }

    public function getCategoriesName()
    {
        return $this->categories->count() > 0
            ? implode(',' ,  $this->categories()->pluck('name')->toArray())
            : 'ندارد' ;
    }
}
