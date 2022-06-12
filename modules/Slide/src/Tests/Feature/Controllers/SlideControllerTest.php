<?php

namespace Modules\Slide\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Slide\Models\Slide;
use Modules\User\Models\User;
use Tests\TestCase;

class SlideControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $response = $this->get(route('panel.slides.index'));

        $response->assertViewIs('Slide::index')
            ->assertViewHasAll([
                'slide' => Slide::query()->get() ,
            ]);
    }

//    public function test_create_method()
//    {
//        $this->actingAsUser();
//        $response = $this->get(route('panel.attributes.create'));
//
//        $response->assertViewIs('Attribute::create')
//            ->assertViewHasAll([
//                'attributeGroups' => AttributeGroup::all(),
//            ]);
//    }
//
//    public function test_store_method()
//    {
//        $this->actingAsUser();
//        $data = Attribute::factory()->make()->toArray();
//       $response =  $this->post(route('panel.attributes.store') , $data);
//
//       $response->assertRedirect();
//       $this->assertDatabaseCount('attributes' , 1);
//       $this->assertDatabaseHas('attributes' , $data);
//    }
//
//    public function test_edit_method()
//    {
//        $this->actingAsUser();
//        $attribute = Attribute::factory()->create();
//        $response = $this->get(route('panel.attributes.edit' , $attribute->id));
//
//        $response->assertViewIs('Attribute::edit')
//            ->assertViewHasAll([
//                'attribute' => $attribute ,
//                'attributeGroups' => AttributeGroup::all(),
//            ]);
//    }
//
//    public function test_update_method()
//    {
//        $this->actingAsUser();
//        $attribute = Attribute::factory()->create();
//        $data = Attribute::factory()->make()->toArray();
//        $response =  $this->patch(route('panel.attributes.update' , $attribute->id) , $data);
//
//        $response->assertRedirect();
//        $this->assertDatabaseCount('attributes' , 1);
//        $this->assertDatabaseHas('attributes' , $data);
//    }
//
//    public function test_destroy_method()
//    {
//        $this->actingAsUser();
//        $attribute = Attribute::factory()->create();
//        $response =  $this->delete(route('panel.attributes.destroy' , $attribute->id));
//
//        $response->assertJson([
//               'message' =>  "ویژگی  ". $attribute->name." با موفقیت حذف شد."
//            ]);
//        $this->assertDatabaseCount('attributes' , 0);
//        $this->assertDatabaseMissing('attributes' , $attribute->toArray());
//    }

    public function actingAsUser()
    {
       $user =  User::factory()->create();
        $this->actingAs($user);
    }

}
