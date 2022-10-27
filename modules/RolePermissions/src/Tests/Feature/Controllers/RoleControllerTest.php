<?php

namespace Modules\RolePermissions\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\RolePermissions\Models\Role;
use Modules\User\Models\User;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.roles.index'));

        $response->assertViewIs('RolePermissions::roles.index')
            ->assertViewHas('roles' , Role::query()->get());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.roles.create'));


        $response->assertViewIs('RolePermissions::roles.create')
            ->assertViewHas('permissions' , Permission::query()->get());
    }

    public function test_role_can_store()
    {
        $this->actingAsUser();
        $roleData = Role::factory()->make()->toArray();
        $permissions = Permission::factory()->count(3)->create()->pluck('id')->toArray();
        $data = $roleData;
        $data['permissions'] = $permissions;

        $response =  $this->post(route('panel.roles.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('roles' , 1);
        $this->assertDatabaseHas('roles' ,$roleData );
        $this->assertDatabaseCount('role_has_permissions' , 3);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $role = Role::factory()->create();
        $response = $this->get(route('panel.roles.edit' , $role->id));

        $response->assertViewIs('RolePermissions::roles.edit')
            ->assertViewHasAll([
                'role' => $role,
                'permissions' => Permission::query()->get()
            ]);
    }

    public function test_role_can_update()
    {
        $permissions = Permission::factory()->create()->pluck('id')->toArray();
        $role = Role::factory()->create()->syncPermissions($permissions);

        $this->actingAsUser();
        $roleData = Role::factory()->make()->toArray();
        $permissions = Permission::factory()->count(3)->create()->pluck('id')->toArray();
        $data = $roleData;
        $data['permissions'] = $permissions;

        $response =  $this->patch(route('panel.roles.update' , $role->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('roles' , 1);
        $this->assertDatabaseHas('roles' ,$roleData );
        $this->assertDatabaseCount('role_has_permissions' , 3);
    }

    public function test_role_can_destroy()
    {
        $this->actingAsUser();
        $permissions = Permission::factory()->create()->pluck('id')->toArray();
        $role = Role::factory()->create();
        $role->syncPermissions($permissions);

        $response =  $this->delete(route('panel.roles.destroy' , $role->id));

        $response->assertJson([
           'message' => "نقش کاربری ". $role->name ." با موفقیت حذق شد."
        ]);

        $this->assertDatabaseCount('roles' , 0);
        $this->assertDatabaseCount('role_has_permissions' , 0);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS);
        $this->actingAs($user);
    }

}
