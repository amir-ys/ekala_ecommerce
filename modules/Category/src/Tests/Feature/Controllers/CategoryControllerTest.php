<?php

namespace Modules\Category\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.categories.index'));

        $response->assertViewIs('Category::index')
            ->assertViewHas('categories' , Category::query()->latest()->get());
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.categories.create'));
        $response->assertViewIs('Category::create')
            ->assertViewHas('parentCategories' , Category::query()->whereNull('parent_id')->get());
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Category::factory()->make()->toArray();
        $response = $this->post(route('panel.categories.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('categories' , 1);
        $this->assertDatabaseHas('categories' , $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $category =  Category::factory()->create();

        $response = $this->get(route('panel.categories.edit' , $category->id));

        $response->assertViewIs('Category::edit')
            ->assertViewHas('parentCategories' , Category::query()->whereNull('parent_id')->get()->filter(function ($cat) use($category){
                 return $category->id !=  $cat->id;
            }));
    }

    public function test_update_method()
    {
        $this->actingAsUser();
        $category =  Category::factory()->create();
        $data =  Category::factory()->make()->toArray();

        $response = $this->patch(route('panel.categories.update' , $category->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'categories' ,1);
        $this->assertDatabaseHas('categories' , $data );
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $category =  Category::factory()->create();

        $response = $this->delete(route('panel.categories.destroy' , $category->id));
        $response->assertJson([
            'message' => "دسته بندی ". $category->name ." با موفقیت حذف شد."
        ]);
        $this->assertCount(0 ,Category::all() );
        $this->assertDatabaseMissing('categories' , $category->toArray() );
    }

    public function test_validation_request_category_data_has_required()
    {
        $this->actingAsUser();
        $data = [];
        $errors = [
            'name' => __('validation.required' , ['attribute' => 'نام']) ,
            'is_active' => __('validation.required' , ['attribute' => 'وضعیت']) ,
        ];

        $this->post(route('panel.categories.store') , $data)
        ->assertSessionHasErrors($errors);

        $this->patch(route('panel.categories.update' , Category::factory()->create()->id) , $data)
            ->assertSessionHasErrors($errors);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
        $this->actingAs($user);
    }
}
