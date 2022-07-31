<?php

namespace Modules\Blog\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
