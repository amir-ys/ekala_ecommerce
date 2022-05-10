<?php

namespace Modules\Category\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\Category\Enums\CategoryStatus;

class Category extends Model
{
    use HasFactory , Sluggable;
    protected $guarded = [];

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
}
