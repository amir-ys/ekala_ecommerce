<?php

namespace Modules\RolePermissions\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\RolePermissions\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Permission::factory()->make()->toArray();

        Permission::create($data);

        $this->assertDatabaseHas('permissions' , $data);
        $this->assertDatabaseCount('permissions' , 1);
    }
}
