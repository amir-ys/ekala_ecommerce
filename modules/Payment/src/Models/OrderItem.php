<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Payment\Database\Factories\OrderItemFactory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;
use Modules\Product\Models\ProductWarranty;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'order_items';

    public static function factory(): OrderItemFactory
    {
        return new OrderItemFactory();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function warranty(): BelongsTo
    {
        return $this->belongsTo(ProductWarranty::class);
    }
}
