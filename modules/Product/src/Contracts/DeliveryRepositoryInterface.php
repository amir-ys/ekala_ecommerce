<?php

namespace Modules\Product\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface DeliveryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
