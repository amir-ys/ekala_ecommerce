<?php

namespace Modules\User\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
