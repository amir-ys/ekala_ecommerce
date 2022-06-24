<?php

namespace Modules\Coupon\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Coupon\Database\Factories\CouponFactory;

class Coupon extends Model
{
    use HasFactory;

    public static array $types = [
        'amount',
        'percent'
    ];
    protected $guarded = [];

    public static function factory(): CouponFactory
    {
        return new CouponFactory();
    }

}
