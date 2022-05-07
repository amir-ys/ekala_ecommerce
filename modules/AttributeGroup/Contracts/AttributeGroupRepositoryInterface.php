<?php

namespace Modules\AttributeGroup\Contracts;

interface AttributeGroupRepositoryInterface
{
    public function getAllPaginate();
    public function findById(int $id);
    public function store(array $data);
    public function update(int $id,array $data);
    public function destroy(int $id);
}
