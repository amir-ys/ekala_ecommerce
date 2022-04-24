<?php

namespace Modules\Brand\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\Database\Factories\BrandFactory;
use Modules\Brand\Enums\BrandStatus;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function factory(): BrandFactory
    {
        return new BrandFactory();
    }
    protected $casts = [
      'is_active'=> BrandStatus::class
    ];

    public function statusCssClass() :Attribute
    {
        return  Attribute::get(function (){
           if ($this->is_active->value == BrandStatus::ACTIVE->value) return  'success' ;
           if ($this->is_active->value == BrandStatus::INACTIVE->value) return  'danger' ;
        });
    }
}
