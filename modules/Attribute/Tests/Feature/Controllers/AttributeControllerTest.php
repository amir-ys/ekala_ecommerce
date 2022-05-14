<?php

namespace Modules\Attribute\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;
use Tests\TestCase;

class AttributeControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_method()
    {
        $response = $this->get(route('panel.attributes.index'));

        $response->assertViewIs('Attribute::index')
            ->assertViewHasAll([
                'attributes' => Attribute::query()->latest()->paginate() ,
            ]);
    }

    public function test_create_method()
    {
        $response = $this->get(route('panel.attributes.create'));

        $response->assertViewIs('Attribute::create')
            ->assertViewHasAll([
                'attributeGroups' => AttributeGroup::all(),
            ]);
    }

    public function test_store_method()
    {
        $data = Attribute::factory()->make()->toArray();
       $response =  $this->post(route('panel.attributes.store') , $data);

       $response->assertRedirect();
       $this->assertDatabaseCount('attributes' , 1);
       $this->assertDatabaseHas('attributes' , $data);
    }

}
