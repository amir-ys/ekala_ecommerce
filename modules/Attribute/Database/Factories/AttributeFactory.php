<?php

namespace Modules\Attribute\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Attribute\Models\Attribute;
use Modules\AttributeGroup\Models\AttributeGroup;

/**
 * @extends Factory
 */
class AttributeFactory extends Factory
{
    protected $model = Attribute::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word() ,
            'attribute_group_id' => AttributeGroup::factory() ,
            'is_filterable' => $this->faker->randomElement([0, 1])
        ];
    }
}
