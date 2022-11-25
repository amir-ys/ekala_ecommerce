<?php

namespace Modules\Slide\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Services\ImageService;
use Modules\Slide\Database\Factories\SlideFactory;
use Modules\Slide\Enums\SlideStatus;
use Modules\Slide\Enums\SlideType;

class Slide extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];
    protected $table = 'sliders';
    protected $casts = [
        'status' => SlideStatus::class ,
        'type' => SlideType::class ,
        'image' => 'array' ,
    ];

    protected static function boot()
    {
        parent::boot();
        self::deleting(function ($slide){
            ImageService::deleteImage($slide->image , self::getUploadDir());
        });
    }

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
