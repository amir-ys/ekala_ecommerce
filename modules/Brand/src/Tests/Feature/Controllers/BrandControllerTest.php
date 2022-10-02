<?php

namespace Modules\Brand\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Modules\User\Models\User;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.brands.index'));

        $response->assertViewIs('Brand::index')
            ->assertViewHas('brands' , Brand::query()->latest()->get());
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Brand::factory()->make()->toArray();
        $response = $this->post(route('panel.brands.store'), $data);

        $this->assertDatabaseCount('brands' , 1);
        $this->assertDatabaseHas('brands' , $data);
        $response->assertRedirect();
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $brand = Brand::factory()->create();
        $response = $this->get(route('panel.brands.edit' , $brand->id));

        $response->assertViewIs('Brand::edit')
            ->assertViewHas('brand' , $brand);

    }


    public function test_update_method()
    {
        $this->actingAsUser();
        $brand = Brand::factory()->create();
        $data = Brand::factory()->make()->toArray();
        $dataForUpdate = $data;
        $response = $this->patch(route('panel.brands.update' , $brand->id), $dataForUpdate);

        $this->assertDatabaseCount('brands' , 1);
        $this->assertDatabaseHas('brands' , $data);
        $response->assertRedirect();
    }


    public function test_destroy_method()
    {
        $this->actingAsUser();
        $brand = Brand::factory()->create();

        $response = $this->delete(route('panel.brands.destroy' ,  $brand->id));

        $this->assertDatabaseCount('brands' ,0 );
        $this->assertDatabaseMissing('brands' ,$brand->toArray());
        $response->assertJson([
            'status' => 1
        ]);
    }

    public function test_validation_request_brand_data_has_required()
    {
        $this->actingAsUser();
        $data = [];
        $errors = [
            'name' =>  __('validation.required' , [ 'attribute' =>  'نام']  ),
            'is_active' =>   __('validation.required' , ['attribute' =>  'وضعیت']),
        ];

        $this->post(route('panel.brands.store') , $data)
            ->assertSessionHasErrors($errors);

        $this->post(route('panel.brands.update' , Brand::factory()->create()->id) , $data)
            ->assertSessionHasErrors($errors);
    }

    public function actingAsUser()
    {
        $user =  User::factory()->create();
        $this->actingAs($user);
    }

}
