<?php

namespace Modules\Comment\Traits;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Comment\Models\Comment;

trait Commentable
{
    use HasRelationships;
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class , 'commentable');
    }

    public function approvedComments(): MorphMany
    {
        return $this->comments()
            ->where('is_approved' , Comment::STATUS_APPROVED)
            ->whereNull('parent_id')->with([ 'comments' ,'user']);
    }

}
