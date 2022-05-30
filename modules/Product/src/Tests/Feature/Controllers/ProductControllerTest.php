<?php
namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Database\Factories\ProductImageFactory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
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

    public function test_edit_method()
    {
        $product = Product::factory()
            ->has(ProductImage::factory()->state(['is_primary' => ProductImage::IS_PRIMARY_TRUE]) , 'images')->create();
        $response = $this->get(route('panel.products.edit' , $product->id));

        $response->assertViewIs('Product::edit')
            ->assertViewHasAll([
                'product' => $product ,
                'categories' => Category::all() ,
                'brands' => Brand::all() ,
            ]);

    }

    public function test_post_can_be_update()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory()
            ->has(ProductImage::factory()->state(['is_primary' => ProductImage::IS_PRIMARY_TRUE]) , 'images')->create();
        $data = Product::factory()->make()->toArray();

        $response =$this->patch(route('panel.products.update' , $product->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount('products' , 1);
        $this->assertDatabaseHas('products' , $data);
    }
}
