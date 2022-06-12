<?php

namespace Modules\Slide\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface SlideRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}
