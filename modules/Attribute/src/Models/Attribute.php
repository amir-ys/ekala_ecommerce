<?php

namespace Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Attribute\Database\Factories\AttributeFactory;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Product\Models\Product;

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

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class , 'attribute_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'attribute_product' ,
            'attribute_id' , 'product_id')->withPivot('value')->withTimestamps();
    }

    public function getValueForProduct($product)
    {
        $productPropertyQuery = $this->products()->where('product_id',$product->id)->first();
      return $productPropertyQuery  ? $productPropertyQuery->pivot->value  : null;
    }
}
