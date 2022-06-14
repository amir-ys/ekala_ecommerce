<?php

namespace Modules\Comment\Repositories;

use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Models\Comment;
use Modules\Core\Repositories\BaseRepository;

class CommentRepo extends BaseRepository  implements CommentRepositoryInterface
{
    protected $model = Comment::class;

    public function store(array $data)
    {

    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
}
