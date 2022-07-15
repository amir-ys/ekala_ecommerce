<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Coupon\Models\Coupon;
use Modules\Payment\Database\Factories\OrderFactory;
use Modules\User\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function factory(): OrderFactory
    {
        return new OrderFactory();
    }

    const STATUS_PENDING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = -1;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items()
    {
      return $this->hasMany(OrderItem::class , 'order_id');
    }
}
