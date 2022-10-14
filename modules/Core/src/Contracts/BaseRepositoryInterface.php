<?php

namespace Modules\Core\Contracts;

interface BaseRepositoryInterface
{
    public function findById(int $id);
    public function destroy(int $id);
}
