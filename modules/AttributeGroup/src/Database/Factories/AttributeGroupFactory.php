<?php

namespace Modules\AttributeGroup\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\Category\Models\Category;


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
