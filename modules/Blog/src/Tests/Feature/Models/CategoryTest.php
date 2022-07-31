<?php

namespace Modules\Blog\Tests\Feature\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Category::factory()->make()->toArray();
        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $data['name']);

        Category::create($data);

        $this->assertDatabaseCount('blog_categories', 1);
        $this->assertDatabaseHas('blog_categories', $data);
    }
}
