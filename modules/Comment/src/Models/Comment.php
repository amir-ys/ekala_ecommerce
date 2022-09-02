<?php

namespace Modules\Comment\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Blog\Models\Post;
use Modules\Comment\Database\Factories\CommentFactory;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;

    const SEEN = 1;
    const NOT_SEEN = 0;

    public static $statuses = [
        self::STATUS_APPROVED,
        self::STATUS_PENDING,
        self::STATUS_REJECTED,
    ];

    public static function factory(): CommentFactory
    {
        return new CommentFactory();
    }

    public function commentableTypeName(): Attribute
    {
        return Attribute::get(function () {
            $info['type'] = 'نامعلوم';
            if ($this->commentable instanceof Product) {
                $info['type'] = 'محصول';
                $info['name'] = $this->commentable->name;
            }
            if ($this->commentable instanceof Post) {
                $info['type'] = 'وبلاگ';
                $info['name'] = $this->commentable->title;
            }
            return $info['type'] . '/' . $info['name'];
        });
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function statusCssClass(): Attribute
    {
        return Attribute::get(function () {
            if ($this->is_approved == self::STATUS_PENDING) return 'warning';
            if ($this->is_approved == self::STATUS_REJECTED) return 'danger';
            if ($this->is_approved == self::STATUS_APPROVED) return 'success';
        });
    }

    public function statusName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->is_approved == self::STATUS_PENDING) return 'در انتظار تایید';
            if ($this->is_approved == self::STATUS_REJECTED) return 'رد شده';
            if ($this->is_approved == self::STATUS_APPROVED) return 'تایید شده';
        });
    }
}


