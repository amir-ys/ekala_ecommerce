<?php

namespace Modules\Category\Tests\Feature\Models\Controllers;

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

}
