<?php

namespace Modules\Product\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Comment\Traits\Commentable;
use Modules\Payment\Models\OrderItem;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Database\Factories\ProductFactory;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Services\ImageService;

/**
 * @method  Builder active()
 * @method  Builder marketable()
 */

class Product extends Model
{
    use HasFactory, Sluggable, SoftDeletes, Commentable;

    const MARKETABLE = '1';
    const NOT_MARKETABLE = '0';

    public static array $morketableStatuses = [
        'فعال' => self::MARKETABLE,
        'غیر فعال' => self::NOT_MARKETABLE
    ];

    protected $guarded = [];
    protected $casts = [
        'is_active' => ProductStatus::class
    ];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($product){
            $product->attributes()->detach();
            $product->allImages()->delete();
            $product->wishlist()->delete();
            $product->colors()->delete();
            $product->warranties()->delete();
            foreach ($product->allImages as $image) {
                ImageService::deleteImage($image->images, $product->getUploadDirectory());
            }
            resolve(ProductRepositoryInterface::class)->deleteAllImages($product->id);
        });

    }

    public static function factory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
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
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->where('is_primary', ProductImage::IS_PRIMARY_FALSE);
    }

    public function primaryImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductImage::class, 'product_id')->
        where('is_primary', ProductImage::IS_PRIMARY_TRUE);
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function vzt()
    {
        return visits($this);
    }

    public function getUploadDirectory(): string
    {
        $main =  'products' . DIRECTORY_SEPARATOR . $this->id;
        $sub = substr(str_replace(['-' , ':'] , '' , $this->created_at) , 0 , 6);
        return $main . DIRECTORY_SEPARATOR . $sub;
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(\Modules\Attribute\Models\Attribute::class, 'attribute_product',
            'product_id', 'attribute_id')->withPivot('value')->withTimestamps();
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function warranties(): HasMany
    {
        return $this->hasMany(ProductWarranty::class);
    }

    public function formattedPrice(): string
    {
        return number_format($this->price);
    }

    public function path()
    {
        return route('front.product.details', $this->slug);
    }


    public function hasDiscount(): Attribute
    {
        return Attribute::get(function () {
            if (!is_null($this->special_price) && ($this->special_price_start < now() && $this->special_price_end > now())) return true;
        });
    }

    public function priceWithDiscount()
    {
        if (!is_null($this->special_price) && ($this->special_price_start < now() && $this->special_price_end > now())) {
            return $this->price - $this->special_price;
        }
        return $this->price;
    }

    public function finalPrice()
    {
        if ($this->hasDiscount) {
          return  $this->priceWithDiscount();
        }
        return $this->price;
    }

    public function discountAmount()
    {
        $discountAmount = 0;
        if ($this->hasDiscount) {
            $discountAmount = $this->special_price;
        }
        return $discountAmount;
    }

    public function priceWithAttributes($colorId , $warrantyId = null , $withDiscount = false)
    {
        $increaseColorPrice = 0;
        $increaseWarrantyPrice = 0;

        $withDiscount ?   $price = $this->price - $this->discountAmount() :  $price = $this->price;

        if ($color = $this->colors()->where('id', $colorId)->first()) {
            $increaseColorPrice = $color->price_increase;
        }

        if ($warranty = $this->warranties()->where('id', $warrantyId)->first()) {
            $increaseWarrantyPrice = $warranty->price_increase;
        }


        return $price + $increaseColorPrice + $increaseWarrantyPrice;
    }

    public function findProductInWishlist($userId)
    {
        return $this->wishlist()->where('user_id', $userId)->with('user')->first();
    }

    public function colorName($colorId)
    {
        $color =  $this->colors()->where('id' , $colorId)->first();
        return $color ?  $color->color_name : '-';
    }

    public function warrantyName($warrantyId)
    {
        $warranty =  $this->warranties()->where('id' , $warrantyId)->first();
        return $warranty ? $warranty->name : '-';
    }

    public function findColorById($colorId)
    {
        return $this->colors()->where('id' , $colorId)->first();
    }

    public function statusCssClass(): Attribute
    {
        return Attribute::get(function () {
            if ($this->is_active->value == ProductStatus::ACTIVE->value) return 'success';
            if ($this->is_active->value == ProductStatus::INACTIVE->value) return 'danger';
        });
    }

    public function marketableCssClass(): Attribute
    {
        return Attribute::get(function () {
            if ($this->is_marketable == self::MARKETABLE) return 'success';
            if ($this->is_marketable == self::NOT_MARKETABLE) return 'danger';
        });
    }

    public function marketableName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->is_marketable == self::MARKETABLE) return 'بله';
            if ($this->is_marketable == self::NOT_MARKETABLE) return 'خیر';
        });
    }

}

