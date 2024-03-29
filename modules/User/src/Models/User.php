<?php
namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Comment\Models\Comment;
use Modules\Payment\Models\Order;
use Modules\Product\Models\Wishlist;
use Modules\Core\Services\ImageService;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    const STATUS_ACTIVE = "1";
    const STATUS_DISABLE = "0";
    const STATUS_BANNED = "-1";

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    const TWO_FACTOR_AUTH_ENABLE = 1;
    const TWO_FACTOR_AUTH_DISABLE = 0;

    public static $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        'غیر فعال' => self::STATUS_DISABLE,
        'بن' => self::STATUS_BANNED,
    ];

    protected static function boot()
    {
        parent::boot();
        self::deleting(function ($user) {
            ImageService::deleteImage($user->profile, self::getUploadDir());
        });
    }

    public static function factory(): UserFactory
    {
        return new UserFactory();
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    protected $fillable = [
        'username', 'first_name', 'last_name',
        'email', 'mobile', 'email_verified_at', 'card_number',
        'password', 'profile', 'status', 'is_admin', 'national_code' , '2fa_enable'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return !empty($this->is_admin);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public static function getUploadDir()
    {
        return 'users\\profile';
    }

    public function panelPath(): string
    {
        return $this->isAdmin() ?
            '/panel/dashboard' :
            '/';
    }

    public function sendEmailVerificationCode()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function FullName(): Attribute
    {
        return Attribute::get(function () {
            return $this->first_name . ' ' . $this->last_name;
        });
    }

    public function isTwoFactorDisable(): bool
    {
        $twoFactorAuthField = '2fa_enable';
        return $this->$twoFactorAuthField == self::TWO_FACTOR_AUTH_DISABLE;
    }

    public function StatusName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_ACTIVE) $name = 'فعال';
            if ($this->status == self::STATUS_DISABLE) $name = 'غیر فعال';
            if ($this->status == self::STATUS_BANNED) $name = 'بن شده';
            return $name;
        });
    }

    public function StatusCss(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_ACTIVE) $name = 'success';
            if ($this->status == self::STATUS_DISABLE) $name = 'warning';
            if ($this->status == self::STATUS_BANNED) $name = 'danger';
            return $name;
        });
    }

}
