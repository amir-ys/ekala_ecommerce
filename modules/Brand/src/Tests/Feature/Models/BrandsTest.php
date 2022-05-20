<?php

namespace Modules\Brand\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Brand\Models\Brand;
use Tests\TestCase;

class BrandsTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Brand::factory()->make()->toArray();

        Brand::create($data);

        $this->assertDatabaseCount('brands' , 1);
        $this->assertDatabaseHas('brands' , $data);
    }
}
