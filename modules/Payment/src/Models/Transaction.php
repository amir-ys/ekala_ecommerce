<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Database\Factories\TransactionFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function factory(): TransactionFactory
    {
        return new TransactionFactory();
    }

    const STATUS_PENDING = 0;
    const STATUS_FAILED = -1;
    const STATUS_SUCCESS = 1;

    public function order()
    {
        return $this->belongsTo(Order::class , 'order_id');
    }
}
