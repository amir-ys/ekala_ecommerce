<?php

namespace Modules\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory, Sluggable , SoftDeletes;

    protected $table = 'blog_categories';
    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        ' غیر فعال' => self::STATUS_INACTIVE,
    ];

    public static function getUploadDir(): string
    {
        $prefix = 'blog';
        $type = 'category';
        $date = date('Y') . date('m') . date('d');
        return $prefix . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $date . DIRECTORY_SEPARATOR;
    }

    public static function getImageName(): string
    {
        return now()->format('YmdHis') . '_' . Str::random(4);
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
        return route('front.blog.postCategory' , $this->slug);
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
        return $this->hasMany(Post::class , 'category_id');
    }
}
