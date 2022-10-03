<?php

namespace Modules\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\PostFactory;
use Modules\Comment\Traits\Commentable;
use Modules\User\Models\User;

class Post extends Model
{
    use HasFactory , Sluggable  , Commentable ;

    protected $guarded = [];

    const STATUS_ACTIVE = "1";
    const STATUS_INACTIVE = "0";

    const IS_COMMENTABLE = "1";
    const NOT_COMMENTABLE = "0";

    protected $casts = [
        'tags' => 'array'
    ];

    public static array $statuses = [
        'فعال' => self::STATUS_ACTIVE,
        'غیر فعال' => self::STATUS_INACTIVE
    ];

    public static array $commentable = [
        'دارد' => self::IS_COMMENTABLE,
        'ندارد' => self::NOT_COMMENTABLE
    ];

    public static function getUploadDir(): string
    {
        $prefix = 'blog';
        $type = 'post';
        $date = date('Y') . date('m') . date('d');
        return $prefix . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $date . DIRECTORY_SEPARATOR;
    }

    public static function getImageName(): string
    {
        return now()->format('YmdHis') . '_' . Str::random(4);
    }

    public static function factory() :PostFactory
    {
        return  new PostFactory();
    }

    public function sluggable(): array
    {
        return  [
            'slug' => [
                'source' => 'title' ,
            ]
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class , 'author_id');
    }

    public function vzt()
    {
        return visits($this);
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

    public function getShowDate()
    {
       $date =  !is_null($this->published_at) ? $this->published_at : $this->created_at;
       return \Morilog\Jalali\Jalalian::fromFormat( 'Y-m-d H:i:s' ,$date)->format(' %d %B %Y');
    }

    public function tagPath($tag)
    {
        return route('front.blog.postTags' , ['tag' => $tag ]);
    }

}
