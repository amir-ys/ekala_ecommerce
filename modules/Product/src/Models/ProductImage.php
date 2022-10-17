<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Database\Factories\ProductImageFactory;

class ProductImage extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];
    const IS_PRIMARY_TRUE = 1;
    const IS_PRIMARY_FALSE = 0;

    protected $casts = [
        'images' => 'array'
    ];


    public static function factory(): ProductImageFactory
    {
        return new ProductImageFactory();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
