<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Product\Database\Factories\ProductImageFactory;

class ProductImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    const IS_PRIMARY_TRUE = 1;
    const IS_PRIMARY_FALSE = 0;


    public static function factory(): ProductImageFactory
    {
        return new ProductImageFactory();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
