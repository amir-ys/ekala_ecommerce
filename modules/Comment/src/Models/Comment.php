<?php

namespace Modules\Comment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Comment\Database\Factories\CommentFactory;

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
}


