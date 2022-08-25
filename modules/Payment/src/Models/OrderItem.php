<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Payment\Database\Factories\OrderItemFactory;
use Modules\Product\Models\Product;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'order_items';

    public static function factory(): OrderItemFactory
    {
        return new OrderItemFactory();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
