<?php

namespace Modules\AttributeGroup\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\AttributeGroup\Models\AttributeGroup;


class AttributeGroupFactory extends Factory
{
    protected $model = AttributeGroup::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word ,
        ];
    }
}
