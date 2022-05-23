<?php

namespace Modules\Product\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory , Sluggable;

    protected $guarded = [];

    public static function factory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function sluggable(): array
    {
        return  [
            'slug' =>[
                'source' => 'name'
            ]
        ];
    }
}
