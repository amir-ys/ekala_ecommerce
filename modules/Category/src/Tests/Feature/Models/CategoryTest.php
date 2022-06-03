<?php

namespace Modules\Category\Tests\Feature\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Category::factory()->make()->toArray();
        $data['slug'] = SlugService::createSlug(Category::class , 'slug' , $data['name']);

        Category::create($data);

        $this->assertDatabaseCount('categories' , 1);
        $this->assertDatabaseHas('categories' , $data);
    }

    public function test_category_relation_with_childes_category()
    {
        $count = rand(1 , 9);
        $category = Category::factory()->has(Category::factory()->count($count) , 'childes')->create();

        $this->assertCount($count , $category->childes);
        $this->assertInstanceOf(Category::class , $category->childes()->first());
    }

    public function test_category_relation_with_parent_category()
    {
        $category = Category::factory()->for(Category::factory() , 'parent')->create();

        $this->assertTrue(isset($category->parent->id));
        $this->assertInstanceOf(Category::class , $category->parent);
    }
    public function test_category_relation_with_attribute_groups ()
    {
        $count = rand(1 , 9);
            $category = Category::factory()->has(AttributeGroup::factory()->count($count))->create();

        $this->assertCount($count , $category->attributeGroups);
        $this->assertInstanceOf(AttributeGroup::class , $category->attributeGroups()->first());

    }

    public function test_category_relation_with_product ()
    {
        $count = rand(1 , 9);
        $category = Category::factory()->has(Product::factory()->count($count))->create();

        $this->assertCount($count , $category->products);
        $this->assertInstanceOf(Product::class , $category->products()->first());

    }

}
