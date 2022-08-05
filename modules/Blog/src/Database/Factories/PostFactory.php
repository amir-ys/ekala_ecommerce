<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\User\Models\User;

/**
 * @extends Factory
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'summery' => $this->faker->text,
            'body' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'status' => $this->faker->randomElement(Post::$statuses),
            'is_commentable' => $this->faker->randomElement(Post::$commentable),
            'published_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'view_count' => $this->faker->randomNumber(),
        ];
    }
}
