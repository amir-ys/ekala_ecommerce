<?php

namespace Modules\Attribute\Tests\Feature\Controllers;

use Modules\Attribute\Models\Attribute;
use Tests\TestCase;

class AttributeControllerTest extends TestCase
{
    public function test_index_method()
    {
        $response = $this->get(route('panel.attributes.index'));

        $response->assertViewIs('Attribute::index')
            ->assertViewHas('attributes' , Attribute::query()->latest()->paginate());
    }

}
