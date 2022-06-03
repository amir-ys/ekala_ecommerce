<?php

namespace Modules\AttributeGroup\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Category\Models\Category;
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
   }

    public function test_attribute_attributeGroup_relation_with_attribute()
    {
        $count = rand(1 ,9);
        $attributeGroup = AttributeGroup::factory()->has(Attribute::factory()->count($count))->create();

        $this->assertCount($count , $attributeGroup->attributes);
        $this->assertInstanceOf(Attribute::class , $attributeGroup->attributes->first() );
    }

    public function test_attributeGroup_relation_with_categories ()
    {
        $count = rand(1 , 9);
        $attributeGroup = AttributeGroup::factory()->has(Category::factory()->count($count))->create();

        $this->assertCount($count , $attributeGroup->categories);
        $this->assertInstanceOf(Category::class , $attributeGroup->categories()->first());

    }
}
