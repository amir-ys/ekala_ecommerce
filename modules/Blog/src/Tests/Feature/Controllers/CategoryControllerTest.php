<?php

namespace Modules\Blog\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\Blog\Models\Category;
use Modules\User\Models\User;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.blog.categories.index'));

        $response->assertViewIs('Blog::categories.index')
            ->assertViewHas('categories', Category::query()->latest()->get());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.blog.categories.create'));
        $response->assertViewIs('Blog::categories.create');
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Category::factory()->make()->toArray();
        $data['image'] = UploadedFile::fake()->image('cate.jpeg');
        $data['tags'] = ['::php::', '::laravel::'];
        $response = $this->post(route('panel.blog.categories.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('blog_categories', 1);
    }

    public function test_edit_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $category = Category::factory()->create();

        $response = $this->get(route('panel.blog.categories.edit', $category->id));

        $response->assertViewIs('Blog::categories.edit')
            ->assertViewHas('category' , $category);
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $category = Category::factory()->create();
        $data = Category::factory()->make()->toArray();
        $data['image'] = UploadedFile::fake()->image('cate.jpeg');
        $data['tags'] = ['::php::', '::laravel::'];

        $response = $this->patch(route('panel.blog.categories.update', $category->id), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('blog_categories', 1);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $category = Category::factory()->create();

        $response = $this->delete(route('panel.blog.categories.destroy', $category->id));
        $response->assertJson([
            'message' => "دسته بندی " . $category->name . " با موفقیت حذف شد."
        ]);
        $this->assertDatabaseCount('blog_categories', 0);
        $this->assertDatabaseMissing('blog_categories', $category->toArray());
    }

    public function test_validation_request_category_data_has_required()
    {
        $this->actingAsUser();
        $data = [];
        $errors = [
            'name' => __('validation.required', ['attribute' => 'نام']),
        ];

        $this->post(route('panel.blog.categories.store'), $data)
            ->assertSessionHasErrors($errors);

        $this->patch(route('panel.blog.categories.update', Category::factory()->create()->id), $data)
            ->assertSessionHasErrors($errors);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
