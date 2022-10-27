<?php

namespace Modules\Slide\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\Slide\Models\Slide;
use Modules\User\Models\User;
use Tests\TestCase;

class SlideControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.slides.index'));

        $response->assertViewIs('Slide::index')
            ->assertViewHasAll([
                'slides' => Slide::query()->get() ,
            ]);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.slides.create'));

        $response->assertViewIs('Slide::create');
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Slide::factory()->make()->toArray();
        $dataForStore = $data;
        $dataForStore['image'] = UploadedFile::fake()->image('test.png');
       $response =  $this->post(route('panel.slides.store') , $dataForStore);

       $response->assertRedirect();
       $this->assertDatabaseCount('sliders' , 1);
       $this->assertDatabaseHas('sliders' , $data);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $slide = Slide::factory()->create();
        $response = $this->get(route('panel.slides.edit' , $slide->id));

        $response->assertViewIs('Slide::edit')
            ->assertViewHasAll([
                'slide' => $slide ,
            ]);
    }

    public function test_update_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $slide = Slide::factory()->create();
        $data = Slide::factory()->make()->toArray();
        unset($data['image']);
        $response =  $this->patch(route('panel.slides.update' , $slide->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('sliders' , 1);
        $this->assertDatabaseHas('sliders' , $data);
    }

    public function test_destroy_method()
    {
        $this->actingAsUser();
        $slide = Slide::factory()->create();
        $response =  $this->delete(route('panel.slides.destroy' , $slide->id));

        $response->assertJson([
               'message' => "اسلایدر  ". $slide->title." با موفقیت حذف شد."
            ]);
        $this->assertCount(  0 , Slide::all());
        $this->assertDatabaseMissing('sliders' , $slide->toArray());
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_SLIDES);
        $this->actingAs($user);
    }

}
