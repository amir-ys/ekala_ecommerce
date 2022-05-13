<?php

namespace Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Attribute\Database\Factories\AttributeFactory;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static  function factory(): AttributeFactory
    {
        return new AttributeFactory();
    }
}
