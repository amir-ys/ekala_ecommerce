<?php
namespace Modules\Attribute\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Product\Models\Product;
use Tests\TestCase;

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

    public function test_attribute_relation_with_products()
    {
        $count = rand(1 ,9);
        $attribute = Attribute::factory()->hasAttached(Product::factory()->count($count) , ['value' => '::test::'] ,
            'products')->create();

        $this->assertCount($count , $attribute->products);
    }

}
