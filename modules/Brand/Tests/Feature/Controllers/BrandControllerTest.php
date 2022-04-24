<?php

namespace Modules\Brand\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Enums\BrandStatus;
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

}
