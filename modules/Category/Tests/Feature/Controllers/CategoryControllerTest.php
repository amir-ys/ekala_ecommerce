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
        $response->assertViewIs('Category::create');
    }

}
