<?php
namespace Modules\Attribute\Tests\Feature\Models;
use Tests\TestCase;
use Modules\Attribute\Models\Attribute;

class AttributeTest extends TestCase
{
    public function test_insert_data()
    {
        $data = Attribute::factory()->make()->toArray();

        Attribute::create($data);

        $this->assertDatabaseCount('attributes' , 1);
        $this->assertDatabaseHas('attributes' , $data);
    }
}
