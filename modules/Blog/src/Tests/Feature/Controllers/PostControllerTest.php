<?php

namespace Modules\Blog\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\Blog\Models\Post;
use Modules\User\Models\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.blog.posts.index'));

        $response->assertViewIs('Blog::posts.index')
            ->assertViewHas('posts', Post::query()->latest()->get());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.blog.posts.create'));
        $response->assertViewIs('Blog::posts.create');
    }

    public function test_store_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $data = Post::factory()->make()->toArray();

        $data['image'] = UploadedFile::fake()->image('posts.jpeg');
        $response = $this->post(route('panel.blog.posts.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('posts', 1);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $post = Post::factory()->create();

        $response = $this->get(route('panel.blog.posts.edit', $post->id));

        $response->assertViewIs('Blog::posts.edit');
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $post = Post::factory()->create();
        $data = Post::factory()->make()->toArray();
        $data['image'] = UploadedFile::fake()->image('post.jpeg');

        $response = $this->patch(route('panel.blog.posts.update', $post->id), $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('posts', 1);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $post = Post::factory()->create();

        $response = $this->delete(route('panel.blog.posts.destroy', $post->id));
        $response->assertJson([
            'message' => "پست " . $post->name . " با موفقیت حذف شد."
        ]);
        $this->assertDatabaseCount('posts', 0);
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    public function test_validation_request_category_data_has_required()
    {
        $this->actingAsUser();
        $data = [];
        $errors = [
            'name' => __('validation.required', ['attribute' => 'نام']),
        ];

        $this->post(route('panel.blog.posts.store'), $data)
            ->assertSessionHasErrors($errors);

        $this->patch(route('panel.blog.posts.update', Post::factory()->create()->id), $data)
            ->assertSessionHasErrors($errors);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
