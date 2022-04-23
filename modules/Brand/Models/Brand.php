<?php

namespace Modules\Brand\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\Database\Factories\BrandFactory;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function factory(): BrandFactory
    {
        return new BrandFactory();
    }

}
