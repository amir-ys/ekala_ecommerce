<?php

namespace Modules\Coupon\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface CommonDiscountRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
