<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Category;

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
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'status' => $this->faker->randomElement([Category::STATUS_ACTIVE, Category::STATUS_INACTIVE]),
            'tags' => '::laravel::'
        ];
    }
}
