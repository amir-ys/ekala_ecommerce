<?php

namespace Modules\Attribute\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class AttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.attributes.index'));

        $response->assertViewIs('Attribute::index')
            ->assertViewHasAll([
                'attributes' => Attribute::query()->get(),
            ]);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.attributes.create'));

        $response->assertViewIs('Attribute::create')
            ->assertViewHasAll([
                'attributeGroups' => AttributeGroup::all(),
            ]);
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Attribute::factory()->make()->toArray();
        $response = $this->post(route('panel.attributes.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('attributes', 1);
        $this->assertDatabaseHas('attributes', $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $attribute = Attribute::factory()->create();
        $response = $this->get(route('panel.attributes.edit', $attribute->id));

        $response->assertViewIs('Attribute::edit')
            ->assertViewHasAll([
                'attribute' => $attribute,
                'attributeGroups' => AttributeGroup::all(),
            ]);
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $attribute = Attribute::factory()->create();
        $data = Attribute::factory()->make()->toArray();
        $response = $this->patch(route('panel.attributes.update', $attribute->id), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('attributes', 1);
        $this->assertDatabaseHas('attributes', $data);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $attribute = Attribute::factory()->create();
        $response = $this->delete(route('panel.attributes.destroy', $attribute->id));

        $response->assertJson(
            [
                'message' => "ویژگی  " . $attribute->name . " با موفقیت حذف شد."
            ]);

        $this->assertCount(0 ,Attribute::all() );
        $this->assertDatabaseMissing('attributes', $attribute->toArray());
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_ATTRIBUTES);
        $this->actingAs($user);
    }
}
