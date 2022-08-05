<?php

namespace Modules\Blog\Tests\Feature\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\User\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_data()
    {
        $data = Post::factory()->make()->toArray();
        $data['slug'] = SlugService::createSlug(Post::class, 'slug', $data['title']);

        Post::create($data);

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', $data);
    }

    public function test_post_relation_with_category()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->for($category)->create();


        $this->assertTrue(isset($post->category->id));
        $this->assertEquals($post->category->id , $category->id);
    }

    public function test_post_relation_with_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();


        $this->assertTrue(isset($post->user->id));
        $this->assertEquals($post->user->id , $user->id);
    }
}
