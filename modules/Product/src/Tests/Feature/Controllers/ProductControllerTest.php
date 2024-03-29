<?php

namespace Modules\Product\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Modules\Attribute\Models\Attribute;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.products.index'));

        $response->assertViewIs('Product::index')
            ->assertViewHas([
                'products' => Product::query()->latest()->get()
            ]);
    }

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.products.create'));
        $response->assertViewIs('Product::create')
            ->assertViewHas([
                'brands' => Brand::all(),
                'categories' => Category::all()
            ]);
    }

    public function test_product_can_be_store()
    {
        $this->actingAsUser();
        $data = Product::factory()->make()->toArray();
        $dataWithoutImage = $data;
        $data['primary_image'] = UploadedFile::fake()->image('image.png');
        $data['quantity'] = rand(1, 9);
        $data['color_name'] = 'قرمز';
        $data['color_value'] =  Str::random(5);
        $this->post(route(
            'panel.products.store'), $data);

//        $dataWithoutImage['special_price_start'] = convertJalaliToDate($data['special_price_start'] , 'Y/m/d H:i' );
//        $dataWithoutImage['special_price_end'] = convertJalaliToDate($data['special_price_end'] , 'Y/m/d H:i' );

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', $dataWithoutImage);
    }

    public function test_edit_method()
    {
        $this->actingAsUser();
        $product = Product::factory()
            ->has(ProductImage::factory()
                ->state(['is_primary' => ProductImage::IS_PRIMARY_TRUE])
                ->state(['images' => ['default' => 'test.png']]), 'images')
            ->create();
        $response = $this->get(route('panel.products.edit', $product->id));

        $response->assertViewIs('Product::edit');
    }

    public function test_post_can_be_update()
    {
        $this->actingAsUser();
        $product = Product::factory()
            ->has(ProductImage::factory()->state(['is_primary' => ProductImage::IS_PRIMARY_TRUE]), 'images')->create();

        $data = Product::factory()->make()->toArray();
        $dataWithoutImage = $data;
        $data['primary_image'] = UploadedFile::fake()->image('image.png');
        $data['quantity'] = rand(1, 9);
        $data['color_name'] = 'قرمز';
        $data['color_value'] =  Str::random(5);

        $response = $this->patch(route('panel.products.update', $product->id), $data);

//        $dataWithoutImage['special_price_start'] = convertJalaliToDate($data['special_price_start'] , 'Y/m/d H:i' );
//        $dataWithoutImage['special_price_end'] = convertJalaliToDate($data['special_price_end'] , 'Y/m/d H:i' );

        $response->assertRedirect();
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', $dataWithoutImage);
    }

    public function test_product_can_be_delete()
    {
        $this->actingAsUser();
        $product = Product::factory()->create();
        $attribute = Attribute::factory()->create();
        $data = ['attributes' => [$attribute->id => '::attribute-value::']];
        $this->post(route('panel.products.attributes.save', $product->id), $data);


        $this->delete(route('panel.products.destroy', $product->id));
        $this->isSoftDeletableModel($product->getTable(), $product->toArray());
        $this->assertDatabaseCount('attribute_product', 0);
        $this->assertDatabaseMissing('attribute_product', ['product_id' => $product->id,
            'attribute_id' => $attribute->id, 'value' => $data['attributes'][$attribute->id]]);
    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
        $this->actingAs($user);
    }
}
