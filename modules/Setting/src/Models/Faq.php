<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];

    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;

}
