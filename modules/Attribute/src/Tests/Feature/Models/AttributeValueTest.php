<?php

namespace Modules\Attribute\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Models\AttributeValue;
use Tests\TestCase;

class AttributeValueTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = AttributeValue::factory()->make()->toArray();

        AttributeValue::create($data);

        $this->assertDatabaseHas('attribute_values' , $data);
        $this->assertDatabaseCount('attribute_values' , 1);
    }

    public function test_attribute_value_relation_relation_with_attributes()
    {
       $attributeValue =  AttributeValue::factory()->for(Attribute::factory())->create();

       $this->assertTrue(isset($attributeValue->attribute->id));
       $this->assertInstanceOf(Attribute::class , $attributeValue->attribute);
    }

}
