<?php

namespace Modules\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\PostFactory;
use Modules\User\Models\User;

class Post extends Model
{
    use HasFactory , Sluggable;

    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_COMMENTABLE = 1;
    const NOT_COMMENTABLE = 0;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'author_id');
    }
}
