<?php

namespace Modules\Blog\Tests\Feature\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Category::factory()->make()->toArray();
        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $data['name']);
        $data['image'] = json_decode($data['image']);

        Category::create($data);

        $this->assertDatabaseCount('blog_categories', 1);
        $this->assertDatabaseHas('blog_categories', $data);
    }

    public function test_category_relation_with_post()
    {
        $count = rand(1, 9);
        $category = Category::factory()->has(Post::factory()->count($count))->create();


        self::assertCount($count , $category->posts);
        self::assertTrue(isset($category->posts()->first()->id));

    }
}
