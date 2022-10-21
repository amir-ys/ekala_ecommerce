<?php

namespace Modules\RolePermissions\Repositories;


use Modules\Core\Repositories\BaseRepository;
use Modules\RolePermissions\Contracts\RoleRepositoryInterface;
use Modules\RolePermissions\Models\Role;

class RoleRepo extends BaseRepository implements RoleRepositoryInterface
{
    protected string $model = Role::class;

    public function store(array $data)
    {
        $role = $this->query->create([
            'name' => $data['name']
        ]);
        $role->syncPermissions($data['permissions']);

    }

    public function update(int $id, array $data)
    {
        $role = $this->findById($id);
        $role->syncPermissions($data['permissions'])->update([
            'name' => $data['name']
        ]);
    }

}
