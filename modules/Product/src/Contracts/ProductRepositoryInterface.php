<?php

namespace Modules\Product\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
