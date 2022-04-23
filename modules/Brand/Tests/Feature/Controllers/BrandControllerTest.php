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

}
