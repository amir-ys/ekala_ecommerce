<?php
namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $response = $this->get(route('panel.products.index'));

        $response->assertViewIs('Product::index')
            ->assertViewHas([
                'products' => Product::query()->latest()->get()
            ]);
    }

    public function test_create_method()
    {
        $response = $this->get(route('panel.products.create'));
        $response->assertViewIs('Product::create')
            ->assertViewHas([
                'brands' => Brand::all() ,
                'categories' => Category::all()
            ]);
    }

    public function test_product_can_be_store()
    {
        $data = Product::factory()->make()->toArray();
        $dataWithoutImage = $data;
        $data['primary_image'] = UploadedFile::fake()->image('image.png');
        $this->post(route('panel.products.store') , $data);

        $this->assertDatabaseCount('products' , 1);
        $this->assertDatabaseHas('products' , $dataWithoutImage);
    }
}
