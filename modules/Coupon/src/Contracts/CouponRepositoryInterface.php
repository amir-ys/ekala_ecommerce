<?php

namespace Modules\Coupon\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface CouponRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
