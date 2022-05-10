<?php

namespace Modules\Category\Tests\Feature\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Category\Models\Category;

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

}
