<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public static $provinces = [
        1 => "آذربایجان‌شرقی",
        2 => "آذربایجان‌غربی",
        3 => "اردبیل",
        4 => "اصفهان",
        5 => "البرز",
        6 => "ایلام",
        7 => "بوشهر",
        8 => "تهران",
        9 => "چهارمحال‌و‌بختیاری",
        10 => "خراسان‌جنوبی",
        11 => "خراسان‌رضوی",
        12 => "خراسان‌شمالی",
        13 => "خوزستان",
        14 => "زنجان",
        15 => "سمنان",
        16 => "سیستان‌و‌بلوچستان",
        17 => "فارس",
        18 => "قزوین",
        19 => "قم",
        20 => "كردستان",
        21 => "كرمان ",
        22 => "كرمانشاه",
        23 => "کهگیلویه‌و‌بویراحمد",
        24 => "گلستان",
        25 => "گیلان",
        26 => "لرستان",
        27 => "مازندران",
        28 => "مركزی",
        29 => "هرمزگان",
        30 => "همدان",
        31 => "یزد",
    ];
}
