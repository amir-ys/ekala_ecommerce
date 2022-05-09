<?php

namespace Modules\AttributeGroup\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AttributeGroup\Models\AttributeGroup;
use Tests\TestCase;

class AttributeGroupControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_method()
    {
        $response = $this->get(route('panel.attributeGroups.index'));
        $response->assertViewIs('AttributeGroup::index')
            ->assertViewHas('attributeGroups' , AttributeGroup::query()->paginate() );
    }

    public function test_edit_method()
    {
        $attributeGroup = AttributeGroup::factory()->create();

        $response = $this->get(\route('panel.attributeGroups.edit' , $attributeGroup->id));

        $response->assertViewIs('AttributeGroup::edit')
            ->assertViewHas('attributeGroup' , $attributeGroup );

    }

    public function test_store_method()
    {
        $data = AttributeGroup::factory()->make()->toArray();
        $response = $this->post(route('panel.attributeGroups.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_groups',1);
        $this->assertDatabaseHas('attribute_groups' , $data);
    }

    public function test_update_method()
    {
        $attributeGroup = AttributeGroup::factory()->create();
        $data = AttributeGroup::factory()->make()->toArray();

        $response = $this->patch(route('panel.attributeGroups.update' , $attributeGroup->id ), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_groups',1);
        $this->assertDatabaseHas('attribute_groups' , $data);
    }



}
