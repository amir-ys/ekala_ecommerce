<?php
namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\Factories\UserAddressFactory;

class UserAddress extends Model {
    use HasFactory;

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
}
