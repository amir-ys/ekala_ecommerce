<?php

namespace Modules\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Blog\Database\Factories\CategoryFactory;
use Modules\Core\Services\ImageService;
class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $table = 'blog_categories';
    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        ' غیر فعال' => self::STATUS_INACTIVE,
    ];

    protected $casts = [
        'image' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        self::deleting(function ($category){
            ImageService::deleteImage($category->image, $category->getUploadDir());
        });
    }

    public function getUploadDir(): string
    {
        $prefix = 'blog';
        $type = 'category';
        $date = substr(str_replace(['-', ':'], '', $this->created_at), 0, 6);
        return $prefix . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR  .  $date;
    }

    public function getImageName(): string
    {
        return $this->id . '_' . now()->format('YmdHis') . '_' . random_int(1 , 100);
    }

    public static function factory(): CategoryFactory
    {
        return new CategoryFactory();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function path()
    {
        return route('front.blog.postCategory', $this->slug);
    }

    public function statusCssClass(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_ACTIVE) return 'success';
            if ($this->status == self::STATUS_INACTIVE) return 'danger';
        });
    }

    public function statusName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status == self::STATUS_ACTIVE) return 'فعال';
            if ($this->status == self::STATUS_INACTIVE) return 'غبر فعال';
        });
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
