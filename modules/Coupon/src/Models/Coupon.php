<?php

namespace Modules\Coupon\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Coupon\Database\Factories\CouponFactory;
use Modules\Payment\Models\Order;
use Modules\User\Models\User;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_AMOUNT = 'amount';
    const TYPE_PERCENT = 'discount';

    const USE_TYPE_PUBLIC = 1;
    const USE_TYPE_PRIVATE = 2;

    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '0';

    public static array $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        ' غیر فعال' => self::STATUS_INACTIVE,
    ];

    public static array $types = [
        'درصد' => self::TYPE_PERCENT,
        'قیمت' => self::TYPE_AMOUNT,
    ];

    public static array $useTypes = [
        'خصوصی(برای کاربر خاص)' => self::USE_TYPE_PRIVATE,
        'عمومی'                 => self::USE_TYPE_PUBLIC,
    ];
    protected $guarded = [];

    public static function factory(): CouponFactory
    {
        return new CouponFactory();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function useTypeName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->use_type == self::USE_TYPE_PUBLIC) return 'عمومی';
            if ($this->use_type == self::USE_TYPE_PRIVATE) return  'خصوصی (برای کاربر خاص)';
        });
    }

    public function statusCssClass(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_ACTIVE) return 'success';
            if ($this->status == self::STATUS_INACTIVE) return 'danger';
        });
    }

    public function statusName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_ACTIVE) return 'فعال';
            if ($this->status == self::STATUS_INACTIVE) return 'غبر فعال';
        });
    }

}
