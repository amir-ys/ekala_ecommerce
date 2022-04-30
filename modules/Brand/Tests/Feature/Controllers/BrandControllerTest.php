<?php

namespace Modules\Brand\Tests\Feature\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $response = $this->get(route('panel.brands.index'));

        $response->assertViewIs('Brand::index')
            ->assertViewHas('brands' , Brand::query()->latest()->paginate());
    }

    public function test_store_method()
    {
        $data = Brand::factory()->make()->toArray();
        $response = $this->post(route('panel.brands.store'), $data);

        $this->assertDatabaseCount('brands' , 1);
        $this->assertDatabaseHas('brands' , $data);
        $response->assertRedirect();
    }

    public function test_edit_method()
    {
        $brand = Brand::factory()->create();
        $response = $this->get(route('panel.brands.edit' , $brand->id));

        $response->assertViewIs('Brand::edit')
            ->assertViewHas('brand' , $brand);

    }


    public function test_update_method()
    {
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

}
