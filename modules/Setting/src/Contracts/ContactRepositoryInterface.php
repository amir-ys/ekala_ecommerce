<?php

namespace Modules\Setting\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface ContactRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);
}
