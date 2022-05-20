<?php

namespace Modules\Attribute\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Models\AttributeValue;

/**
 * @extends Factory=Modules\Attribute\Models>
 */
class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'attribute_id' => Attribute::factory() ,
            'value' => $this->faker->word() ,
        ];
    }
}
