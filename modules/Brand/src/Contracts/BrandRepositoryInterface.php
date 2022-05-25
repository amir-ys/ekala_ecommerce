<?php

namespace Modules\Brand\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface BrandRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
