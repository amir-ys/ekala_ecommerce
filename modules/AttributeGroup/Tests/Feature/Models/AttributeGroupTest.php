<?php

namespace Modules\AttributeGroup\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AttributeGroup\Models\AttributeGroup;
use Tests\TestCase;

class AttributeGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = AttributeGroup::factory()->make()->toArray();
        AttributeGroup::create($data);

        $this->assertDatabaseCount('attribute_groups' , 1);
        $this->assertDatabaseHas('attribute_groups' , $data);
;    }

}
