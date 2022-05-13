<?php
namespace Modules\Attribute\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AttributeGroup\Models\AttributeGroup;
use Tests\TestCase;
use Modules\Attribute\Models\Attribute;

class AttributeTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Attribute::factory()->make()->toArray();

        Attribute::create($data);

        $this->assertDatabaseCount('attributes' , 1);
        $this->assertDatabaseHas('attributes' , $data);
    }

    public function test_attribute_relation_with_attributeGroup()
    {
        $attribute = Attribute::factory()->for(AttributeGroup::factory())->create();

        $this->assertTrue(isset($attribute->attributeGroup->id));
        $this->assertInstanceOf(AttributeGroup::class , $attribute->attributeGroup );
    }
}
