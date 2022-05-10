<?php

namespace Modules\Category\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Models\Category;

/**
 * @extends Factory
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word() ,
            'is_active' => $this->faker->randomElement([0 ,1]) ,
            'is_searchable' => $this->faker->randomElement([0 ,1]) ,
        ];
    }
}
