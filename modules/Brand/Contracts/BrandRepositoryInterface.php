<?php

namespace Modules\Brand\Contracts;

interface BrandRepositoryInterface
{
    public function getAllPaginate();
    public function findById(int $id);
    public function store(array $data);
    public function update(int $id,array $data);
    public function destroy(int $id);

}
