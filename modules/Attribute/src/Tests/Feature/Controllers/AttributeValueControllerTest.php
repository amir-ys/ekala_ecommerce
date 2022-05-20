<?php

namespace Modules\Attribute\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Models\AttributeValue;
use Tests\TestCase;

class AttributeValueControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_value_index_method()
    {
        $attribute = Attribute::factory()->create();
        $response = $this->get(route('panel.attributes.value.index' , $attribute->id));

        $response->assertViewIs('Attribute::attribute-value.save')
            ->assertViewHas('attribute' , Attribute::query()->findOrFail($attribute->id));
    }

    public function test_save_value__method()
    {
        $attribute = Attribute::factory()->create();
        $data = ['attributeValue' => [ 'value::1' , 'value::2' , 'value::3' ] ];
        $response = $this->post(route('panel.attributes.value.save' , $attribute->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_values' , count($data['attributeValue']));
        $this->assertDatabaseHas('attribute_values' , ['attribute_id' => $attribute->id , 'value' => $data['attributeValue'][0]]);
    }

    public function test_delete_value_method()
    {
        $this->withoutExceptionHandling();
        $count = rand(1 ,9);
        $attribute = Attribute::factory()->create();
        $attributeValues = AttributeValue::factory()->count($count)->for($attribute)->create();
        $response = $this->delete(route('panel.attributes.value.delete' , $attribute->id) , ['value' => $attributeValues->toArray()[0]['value']] );

        $response->assertRedirect();
        $this->assertDatabaseCount('attribute_values' , $count - 1 );
        $this->assertDatabaseMissing('attribute_values' , $attributeValues->toArray()[0]);
    }

}
