<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    const IS_PRIMARY_TRUE = 1;
    const IS_PRIMARY_FALSE = 0;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
