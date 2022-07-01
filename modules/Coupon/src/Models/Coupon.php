<?php

namespace Modules\Coupon\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Coupon\Database\Factories\CouponFactory;

class Coupon extends Model
{
    use HasFactory;

    const TYPE_AMOUNT = 'amount';
    const TYPE_PERCENT = 'discount';

    public static array $types = [
        'درصد' =>  self::TYPE_PERCENT,
       'قیمت' =>  self::TYPE_AMOUNT,
    ];
    protected $guarded = [];

    public static function factory(): CouponFactory
    {
        return new CouponFactory();
    }

}
