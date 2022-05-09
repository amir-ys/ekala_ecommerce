<?php

namespace Modules\AttributeGroup\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface AttributeGroupRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();
}
