<?php

namespace Modules\Slide\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Slide\Database\Factories\SlideFactory;
use Modules\Slide\Enums\SlideStatus;
use Modules\Slide\Enums\SlideType;

class Slide extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sliders';
    protected $casts = [
        'status' => SlideStatus::class ,
        'type' => SlideType::class ,
    ];

    public static function getUploadDir(): string
    {
        return 'sliders';
    }

    public static  function factory(): SlideFactory
    {
        return new SlideFactory();
    }

    public function statusCssClass() :Attribute
    {
        return  Attribute::get(function (){
            if ($this->status->value == SlideStatus::ACTIVE->value) return  'success' ;
            if ($this->status->value == SlideStatus::INACTIVE->value) return  'danger' ;
        });
    }
}
