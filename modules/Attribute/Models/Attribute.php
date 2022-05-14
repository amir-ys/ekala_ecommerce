<?php

namespace Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Attribute\Database\Factories\AttributeFactory;
use Modules\AttributeGroup\Models\AttributeGroup;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    const FILTERABLE_TRUE = 1;
    const FILTERABLE_FALSE = 0;

    public static  function factory(): AttributeFactory
    {
        return new AttributeFactory();
    }

    public function attributeGroup(): BelongsTo
    {
        return $this->belongsTo(AttributeGroup::class , 'attribute_group_id');
    }
}
