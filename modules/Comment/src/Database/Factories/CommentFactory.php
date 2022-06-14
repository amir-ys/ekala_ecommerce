<?php

namespace Modules\Comment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Comment\Models\Comment;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text,
            'parent_id' => Comment::factory(),
            'user_id' => User::factory(),
            'commentable_id' => Product::factory(),
            'commentable_type' => Product::class,
            'is_approved' => $this->faker->randomElement(Comment::$statuses),
        ];
    }
}
