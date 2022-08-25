<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Payment\Database\Factories\PaymentFactory;

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


    const PAYMENT_TYPE_ONLINE = 1;
    const PAYMENT_TYPE_OFFLINE = 2;
    const PAYMENT_TYPE_CASH = 3;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
