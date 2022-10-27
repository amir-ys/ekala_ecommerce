<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Payment\Models\Order;
use Modules\User\Database\Factories\UserAddressFactory;

class UserAddress extends Model
{
    use HasFactory , SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $guarded = [];

    public static $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        'غیر فعال' => self::STATUS_INACTIVE,
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public static function factory(): UserAddressFactory
    {
        return new UserAddressFactory();

    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFullAddress(): Attribute
    {
        return new Attribute(function () {
            return $this->province->name . '|' . $this->city->name . '|آدرس: ' . $this->address;
        });
    }

    public function getAddressReceiver(): Attribute
    {
        return new Attribute(function () {
            return 'کد پستی: ' . $this->postal_code .
                ' | دریافت کننده: ' . $this->receiver .
                ' | شماره تماس دریافت کننده: ' . $this->phone_number;
        });
    }


}
