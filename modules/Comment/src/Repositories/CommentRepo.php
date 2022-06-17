<?php

namespace Modules\Comment\Repositories;

use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Models\Comment;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Models\Product;

class CommentRepo extends BaseRepository  implements CommentRepositoryInterface
{
    protected $model = Comment::class;

    public function store(array $data)
    {
        $this->query->create([
            'body' => $data['body'],
            'parent_id' => $data['parent_id'],
            'user_id' => auth()->id(),
            'commentable_id' => $data['product_id'],
            'commentable_type' => Product::class,
        ]);
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
}
