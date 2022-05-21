<?php

namespace Modules\AttributeGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
}
