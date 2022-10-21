<?php

namespace Modules\RolePermissions\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\RolePermissions\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Role::factory()->make()->toArray();

        Role::create($data);

        $this->assertDatabaseHas('roles' , $data);
        $this->assertDatabaseCount('roles' , 1);
    }
}
