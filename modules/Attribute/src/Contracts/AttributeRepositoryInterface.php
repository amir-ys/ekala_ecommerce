<?php

namespace Modules\Attribute\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();
}
