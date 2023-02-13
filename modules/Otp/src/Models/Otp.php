<?php

namespace Modules\Otp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Otp\Database\Factories\OtpFactory;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otps';
    protected $guarded = [];

    public static function factory(): OtpFactory
    {
        return new OtpFactory();
    }
}


