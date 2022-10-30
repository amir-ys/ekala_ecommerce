<?php

namespace Modules\Comment\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Blog\Models\Post;
use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Models\Comment;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

class CommentRepo extends BaseRepository implements CommentRepositoryInterface
{
    protected $model = Comment::class;

    public function store(array $data)
    {
        $this->query->create([
            'body' => $data['body'],
            'parent_id' => $data['parent_id'],
            'user_id' => $data['user_id'],
            'commentable_id' => $data['model_id'],
            'commentable_type' => $data['model_type'],
            'is_approved' => $data['is_admin'] == User::ROLE_ADMIN ? User::ROLE_ADMIN : User::ROLE_USER ,
            'is_seen' => $data['is_admin'] == User::ROLE_ADMIN ? User::ROLE_ADMIN : User::ROLE_USER ,
        ]);
    }

    public function getParentComments()
    {
        return $this->query->whereNull('parent_id')->get();
    }

    public function getProductComments()
    {
        return $this->query->whereNull('parent_id')
            ->whereMorphedTo('commentable', Product::class)
            ->get();
    }

    public function getBlogComments()
    {
        return $this->query->whereNull('parent_id')
            ->whereMorphedTo('commentable', Post::class)
            ->get();
    }

    public function changeStatus($id, $status)
    {
        $model = $this->query->where('id', $id)->firstOrFail();
        $model->is_approved = $status;
        $model->save();
    }

    public function getUnseenComments(): array|Collection
    {
        return $this->query->where('is_seen', Comment::NOT_SEEN)->get();
    }

    public function changeSeen($id = null, $type = null)
    {
        $type ? $query = $this->query->whereMorphedTo('commentable', $type)
            : $query = $this->query;

        if (!is_null($id)) {
            $query->where('id', $id)->update(['is_seen' => Comment::SEEN]);
        } else {
            $query->getQuery()->update(['is_seen' => Comment::SEEN]);
        }
    }
}
