<?php

namespace Modules\Comment\Repositories;

use Modules\Blog\Models\Post;
use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Models\Comment;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Models\Product;

class CommentRepo extends BaseRepository implements CommentRepositoryInterface
{
    protected $model = Comment::class;

    public function store(array $data)
    {
        $this->query->create([
            'body' => $data['body'],
            'parent_id' => $data['parent_id'],
            'user_id' => auth()->id(),
            'commentable_id' => $data['model_id'],
            'commentable_type' => $data['model_type'],
        ]);
    }

    public function getParentComments()
    {
        return $this->query->whereNull('parent_id')->get();
    }

    public function getProductComments()
    {
        return $this->query->whereNull('parent_id')
            ->whereMorphedTo('commentable' , Product::class )
            ->get();
    }

    public function getBlogComments()
    {
        return $this->query->whereNull('parent_id')
            ->whereMorphedTo('commentable' , Post::class )
            ->get();
    }

    public function changeStatus($id, $status)
    {
        $model = $this->query->where('id', $id)->firstOrFail();
        $model->is_approved = $status;
        $model->save();
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
}
