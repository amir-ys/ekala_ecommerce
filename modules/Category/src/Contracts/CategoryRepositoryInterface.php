<?php

namespace Modules\Category\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
