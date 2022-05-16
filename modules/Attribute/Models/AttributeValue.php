<?php

namespace Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Attribute\Database\Factories\AttributeValueFactory;

class AttributeValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static  function factory(): AttributeValueFactory
    {
        return new AttributeValueFactory();
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class , 'attribute_id');
    }
}
