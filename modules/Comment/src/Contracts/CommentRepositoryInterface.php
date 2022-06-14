<?php

namespace Modules\Comment\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
