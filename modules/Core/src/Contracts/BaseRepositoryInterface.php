<?php

namespace Modules\Core\Contracts;

interface BaseRepositoryInterface
{
    public function findById(int $id);
    public function store(array $data);
    public function update(int $id,array $data);
    public function destroy(int $id);
}
