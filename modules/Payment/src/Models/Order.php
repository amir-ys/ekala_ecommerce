<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Coupon\Models\CommonDiscount;
use Modules\Coupon\Models\Coupon;
use Modules\Payment\Database\Factories\OrderFactory;
use Modules\Product\Models\Delivery;
use Modules\User\Models\User;
use Modules\User\Models\UserAddress;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function factory(): OrderFactory
    {
        return new OrderFactory();
    }

    const STATUS_PENDING = 0;
    const STATUS_PAID = 1;
    const STATUS_FAILED = -1;
    const STATUS_RETURNED = -2;
    const STATUS_CANCELED = -3;


    const DELIVERY_STATUS_NOT_SEND = 0;
    const DELIVERY_STATUS_SENDING = 1;
    const DELIVERY_STATUS_POSTED = 2;
    const DELIVERY_STATUS_DELIVERED = 3;


    public static array $statuses = [
        'در انتظار پرداخت' => self::STATUS_PENDING,
        'ناموفق' => self::STATUS_FAILED,
        'پرداخت شده' => self::STATUS_PAID,
        'باطل شده' => self::STATUS_CANCELED,
        'مرجوعی' => self::STATUS_RETURNED,
    ];

    public static array $deliveryStatuses = [
        'ارسال نشده' => self::DELIVERY_STATUS_NOT_SEND,
        'در حال ارسال' => self::DELIVERY_STATUS_SENDING,
        'ارسال شده' => self::DELIVERY_STATUS_POSTED,
        'تحویل شده' => self::DELIVERY_STATUS_DELIVERED,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function userAddress(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount(): BelongsTo
    {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function statusName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_PENDING) return array_keys(self::$statuses)[0];
            if ($this->status == self::STATUS_FAILED) return array_keys(self::$statuses)[1];
            if ($this->status == self::STATUS_PAID) return array_keys(self::$statuses)[2];
            if ($this->status == self::STATUS_CANCELED) return array_keys(self::$statuses)[3];
            if ($this->status == self::STATUS_RETURNED) return array_keys(self::$statuses)[4];
        });
    }

    public function statusCss(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_FAILED) return 'danger';
            if ($this->status == self::STATUS_PAID) return 'success';
            if ($this->status == self::STATUS_PENDING) return 'warning';
            if ($this->status == self::STATUS_CANCELED) return 'warning';
            if ($this->status == self::STATUS_RETURNED) return 'warning';
        });
    }

    public function deliveryStatusName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->delivery_status == self::DELIVERY_STATUS_NOT_SEND) return array_keys(self::$deliveryStatuses)[0];
            if ($this->delivery_status == self::DELIVERY_STATUS_SENDING) return array_keys(self::$deliveryStatuses)[1];
            if ($this->delivery_status == self::DELIVERY_STATUS_POSTED) return array_keys(self::$deliveryStatuses)[2];
            if ($this->delivery_status == self::DELIVERY_STATUS_DELIVERED) return array_keys(self::$deliveryStatuses)[3];
        });
    }

    public function deliveryStatusCss(): Attribute
    {
        return Attribute::get(function () {
            if ($this->delivery_status == self::DELIVERY_STATUS_SENDING) return 'light';
            if ($this->delivery_status == self::DELIVERY_STATUS_POSTED) return 'warning';
            if ($this->delivery_status == self::DELIVERY_STATUS_DELIVERED) return 'success';
            if ($this->delivery_status == self::DELIVERY_STATUS_NOT_SEND) return 'danger';
        });
    }

}
