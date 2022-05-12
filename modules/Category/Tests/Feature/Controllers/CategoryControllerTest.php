<?php

namespace Modules\Category\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Models\Category;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $response = $this->get(route('panel.categories.index'));

        $response->assertViewIs('Category::index')
            ->assertViewHas('categories' , Category::query()->latest()->paginate());
    }

    public function test_create_method()
    {
        $response = $this->get(route('panel.categories.create'));
        $response->assertViewIs('Category::create')
            ->assertViewHas('parentCategories' , Category::query()->whereNull('parent_id')->get());
    }

    public function test_store_method()
    {
        $data = Category::factory()->make()->toArray();
        $response = $this->post(route('panel.categories.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('categories' , 1);
        $this->assertDatabaseHas('categories' , $data);
    }

}
