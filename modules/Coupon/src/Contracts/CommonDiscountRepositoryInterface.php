<?php

namespace Modules\Coupon\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface CommonDiscountRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id,array $data);
}
