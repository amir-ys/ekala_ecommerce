<?php
namespace Modules\Slide\Tests\Feature\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Slide\Models\Slide;
use Tests\TestCase;

class SlideTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Slide::factory()->make()->toArray();

        Slide::create($data);

        $this->assertDatabaseCount('sliders' , 1);
        $this->assertDatabaseHas('sliders' , $data);
    }

}
