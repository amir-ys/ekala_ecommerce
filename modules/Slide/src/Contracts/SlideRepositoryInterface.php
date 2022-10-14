<?php

namespace Modules\Slide\Contracts;

use Modules\Core\Contracts\BaseRepositoryInterface;

interface SlideRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(int $id,array $data);
}
