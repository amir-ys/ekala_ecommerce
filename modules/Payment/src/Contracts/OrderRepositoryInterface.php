<?php

namespace Modules\Payment\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);
}
