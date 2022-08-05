<?php

namespace Modules\Blog\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
