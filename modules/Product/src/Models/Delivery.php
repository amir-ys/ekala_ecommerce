<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Database\Factories\DeliveryFactory;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delivery';
    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static array $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        'غیر فعال' => self::STATUS_INACTIVE
    ];


    public static function factory()
    {
        return new DeliveryFactory();
    }

    public function statusCss(): Attribute
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
            if ($this->status == self::STATUS_INACTIVE) return 'غیر فعال';
        });
    }
}
