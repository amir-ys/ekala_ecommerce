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

}
