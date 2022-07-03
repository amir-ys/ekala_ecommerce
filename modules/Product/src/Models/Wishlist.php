<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    protected $guarded = [];
    protected $with = [ 'product' ];

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
