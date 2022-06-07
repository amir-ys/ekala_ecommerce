<?php

namespace Modules\Product\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Database\Factories\ProductFactory;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Http\Controllers\ProductImageController;

class Product extends Model
{
    use HasFactory , Sluggable , SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'is_active' => ProductStatus::class
    ];

    public static function factory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function sluggable(): array
    {
        return  [
            'slug' =>[
                'source' => 'name'
            ]
        ];
    }

    public function statusCssClass() :Attribute
    {
        return  Attribute::get(function (){
            if ($this->is_active->value == ProductStatus::ACTIVE->value) return 'success' ;
            if ($this->is_active->value == ProductStatus::INACTIVE->value) return 'danger' ;
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function allImages(): HasMany
    {
        return $this->hasMany(ProductImage::class , 'product_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class , 'product_id')
            ->where('is_primary' ,ProductImage::IS_PRIMARY_FALSE );
    }

    public function primaryImage() :Attribute
    {
     return Attribute::get(function (){
          return $this->hasMany(ProductImage::class , 'product_id')->
          where('is_primary' , ProductImage::IS_PRIMARY_TRUE)->first();
      });
    }

    public static function getUploadDirectory() :string
    {
        return 'products';
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(\Modules\Attribute\Models\Attribute::class  , 'attribute_product' ,
            'product_id' , 'attribute_id')->withPivot('value')->withTimestamps();
    }

    public function formattedPrice(): string
    {
        return number_format($this->price);
    }

    public function path()
    {
        return route('front.product.details' , $this->slug);
    }

    public function priceWithDiscount()
    {
        return '10,000' ;
    }
}
