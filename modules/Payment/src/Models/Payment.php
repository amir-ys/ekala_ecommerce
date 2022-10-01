<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Payment\Database\Factories\PaymentFactory;
use Modules\User\Models\User;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function factory(): PaymentFactory
    {
        return new PaymentFactory();
    }

    const STATUS_PENDING = 0;
    const STATUS_FAILED = -1;
    const STATUS_SUCCESS = 1;
    const STATUS_PENDING_APPROVAL = 5;


    const PAYMENT_TYPE_ONLINE = 1;
    const PAYMENT_TYPE_OFFLINE = 2;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusName(): Attribute
    {
        return new Attribute(function () {
            get :
            if ($this->status == self::STATUS_PENDING) return 'در انتظار پرداخت';
            if ($this->status == self::STATUS_FAILED) return 'لفو شده';
            if ($this->status == self::STATUS_SUCCESS) return 'پرداخت شده';
        });
    }

    public function statusCss(): Attribute
    {
        return new Attribute(function () {
            get :
            if ($this->status == self::STATUS_PENDING) return 'warning';
            if ($this->status == self::STATUS_FAILED) return 'danger';
            if ($this->status == self::STATUS_SUCCESS) return 'success';
        });
    }


    public function paymentTypeName(): Attribute
    {
        return new Attribute(function () {
            get :
            if ($this->payment_type == self::PAYMENT_TYPE_ONLINE) return 'آنلاین';
            if ($this->payment_type == self::PAYMENT_TYPE_OFFLINE) return 'آفلاین(کارت به کارت)';
        });
    }

    public function paymentTypeCss(): Attribute
    {
        return new Attribute(function () {
            get :
            if ($this->payment_type == self::PAYMENT_TYPE_ONLINE) return 'light';
            if ($this->payment_type == self::PAYMENT_TYPE_OFFLINE) return 'light';
        });
    }

}
