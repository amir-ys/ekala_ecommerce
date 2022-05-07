<?php

namespace Modules\AttributeGroup\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
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

    public function test_store_method()
    {
        $data = AttributeGroup::factory()->make()->toArray();
        $response = $this->post(route('panel.attributeGroups.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_groups',1);
        $this->assertDatabaseHas('attribute_groups' , $data);
    }



}
