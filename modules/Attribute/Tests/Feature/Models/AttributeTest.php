<?php
namespace Modules\Attribute\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\AttributeValue;
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

    public function test_attributes_relation_with_attributeGroup()
    {
        $attribute = Attribute::factory()->for(AttributeGroup::factory())->create();

        $this->assertTrue(isset($attribute->attributeGroup->id));
        $this->assertInstanceOf(AttributeGroup::class , $attribute->attributeGroup );
    }

    public function test_attributes_relation_relation_with_attribute_values()
    {
        $count = rand(1 ,9);
        $attribute =  Attribute::factory()->has(AttributeValue::factory()->count($count) ,'values')->create();

        $this->assertCount($count , $attribute->values);
        $this->assertTrue(isset($attribute->values->first()->id));
        $this->assertInstanceOf(AttributeValue::class , $attribute->values->first());
    }
}
