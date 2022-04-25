<?php

namespace Modules\Brand\Tests\Feature\Controllers;

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
        unset($dataForUpdate['slug']);
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
        $response->assertRedirect();
    }

}
