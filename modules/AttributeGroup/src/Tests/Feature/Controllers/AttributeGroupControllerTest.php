<?php

namespace Modules\AttributeGroup\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class AttributeGroupControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.attributeGroups.index'));
        $response->assertViewIs('AttributeGroup::index')
            ->assertViewHas([
                'attributeGroups' => AttributeGroup::query()->get()  ,
                'categories' => Category::query()->get()
            ]);
    }


    public function test_store_method()
    {
        $this->actingAsUser();
        $count = rand(1 ,9);
        $data = AttributeGroup::factory()->make()->toArray();
        $dataWithCategory = $data;
        $dataWithCategory['category_ids'] =  Category::factory()->count($count)->create()->pluck('id')->toArray();
        $response = $this->post(route('panel.attributeGroups.store') , $dataWithCategory);

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_groups',1);
        $this->assertDatabaseHas('attribute_groups' , $data);

        $this->assertDatabaseCount('attribute_group_category',$count);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $attributeGroup = AttributeGroup::factory()->create();

        $response = $this->get(route('panel.attributeGroups.edit' , $attributeGroup->id));

        $response->assertViewIs('AttributeGroup::edit')
            ->assertViewHas('attributeGroup' , $attributeGroup );

    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $count = rand(1 ,9);
        $attributeGroup = AttributeGroup::factory()->create();
        $data = AttributeGroup::factory()->make()->toArray();
        $dataWithCategory = $data;
        $dataWithCategory['category_ids'] =  Category::factory()->count($count)->create()->pluck('id')->toArray();
        $response = $this->patch(route('panel.attributeGroups.update' , $attributeGroup->id ), $dataWithCategory);

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_groups',1);
        $this->assertDatabaseHas('attribute_groups' , $data);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $attributeGroup = AttributeGroup::factory()->create();
        $response = $this->delete(route('panel.attributeGroups.destroy' , $attributeGroup->id ));

        $response->assertJson([
           'message' =>  'گروه مشخصات'. $attributeGroup->name .' با موفقیت حذف شد.'
        ]);

        $this->assertCount(0 ,AttributeGroup::all() );
        $this->assertDatabaseMissing('attribute_groups' , $attributeGroup->toArray());
    }

    public function test_validation_request_attributeGroup_data_has_required()
    {
        $this->actingAsUser();
        $data = [];
        $errors = [
            'name' =>  __('validation.required' , [ 'attribute' =>  'نام']  ),
        ];

        $this->post(route('panel.attributeGroups.store') , $data)
            ->assertSessionHasErrors($errors);

        $this->post(route('panel.attributeGroups.update' , AttributeGroup::factory()->create()->id) , $data)
            ->assertSessionHasErrors($errors);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_ATTRIBUTE_GROUPS);
        $this->actingAs($user);
    }

}
