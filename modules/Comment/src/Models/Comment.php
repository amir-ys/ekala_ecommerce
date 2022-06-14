<?php

namespace Modules\Comment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Comment\Database\Factories\CommentFactory;
use Modules\User\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;

    public static $statuses = [
      self::STATUS_APPROVED ,
      self::STATUS_PENDING ,
      self::STATUS_REJECTED ,
    ];

    public static function factory(): CommentFactory
    {
        return new CommentFactory();
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
        return $this->belongsTo(Comment::class , 'parent_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class , 'parent_id');
    }
}


