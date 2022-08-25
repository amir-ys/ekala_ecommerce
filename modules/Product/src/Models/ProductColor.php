<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Database\Factories\ProductColorFactory;

class ProductColor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public static function factory()
    {
        return new ProductColorFactory();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
