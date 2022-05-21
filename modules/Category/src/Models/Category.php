<?php

namespace Modules\Category\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\Category\Enums\CategoryStatus;

class Category extends Model
{
    use HasFactory , Sluggable;
    protected $guarded = [];

    const SEARCHABLE_TRUE = 1;
    const SEARCHABLE_FALSE =0;

    protected $casts = [
        'is_active' => CategoryStatus::class
    ];

    public static function factory(): CategoryFactory
    {
        return new CategoryFactory();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function statusCssClass() :Attribute
    {
        return  Attribute::get(function (){
            if ($this->is_active->value == CategoryStatus::ACTIVE->value) return  'success' ;
            if ($this->is_active->value == CategoryStatus::INACTIVE->value) return  'danger' ;
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'parent_id' );
    }

    public function childes(): HasMany
    {
        return $this->hasMany(Category::class , 'parent_id' );
    }

    public function attributeGroups()
    {
        return $this->hasMany(AttributeGroup::class , 'category_id');
    }
}
