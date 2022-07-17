<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    const STATUS_PAID = 1;
    const STATUS_POSTED = 2;
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

    public function statusName() :Attribute
    {
        return Attribute::get(function (){
           if ($this->status == self::STATUS_FAILED) return 'ناموفق';
           if ($this->status == self::STATUS_POSTED) return 'پست شده';
           if ($this->status == self::STATUS_PAID) return 'پرداخت شده';
           if ($this->status == self::STATUS_PENDING) return 'در انتظار پرداخت';
        });
    }

    public function statusCss() :Attribute
    {
        return Attribute::get(function (){
            if ($this->status == self::STATUS_FAILED) return 'danger';
            if ($this->status == self::STATUS_POSTED) return 'success';
            if ($this->status == self::STATUS_PAID) return 'success';
            if ($this->status == self::STATUS_PENDING) return 'warning';
        });
    }

}
