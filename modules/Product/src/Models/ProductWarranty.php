<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Database\Factories\ProductWarrantyFactory;

class ProductWarranty extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];

    public static function factory(): ProductWarrantyFactory
    {
        return new  ProductWarrantyFactory();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
