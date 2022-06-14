<?php

namespace Modules\Comment\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Comment\Models\Comment;
use Modules\Product\Models\Product;
use Modules\User\Models\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    public function test_insert_data()
    {
        $data = Comment::factory()->make()->toArray();

        Comment::create($data);

        $this->assertDatabaseCount('comments' , 1);
        $this->assertDatabaseHas('comments' , $data);
    }

    public function test_comment_relation_with_product()
    {
        $comment= Comment::factory()->for(Product::factory() , 'commentable')->create();

        $this->assertTrue(isset($comment->commentable->id));
        $this->assertInstanceOf(Product::class ,$comment->commentable);

    }

    public function test_comment_relation_with_user()
    {
        $comment = Comment::factory()->for(User::factory() , 'user')->create();

        $this->assertTrue(isset($comment->user->id));
        $this->assertInstanceOf(User::class ,$comment->user);
    }

    public function test_comment_relation_with_parent()
    {
        $comment = Comment::factory()->for(Comment::factory() , 'parent')->create();

        $this->assertTrue(isset($comment->parent->id));
        $this->assertInstanceOf(Comment::class ,$comment->parent);

    }

    public function test_comment_relation_with_comments()
    {
        $count = rand(1 ,9);
        $comment = Comment::factory()->has(Comment::factory()->count($count) , 'comments')->create();

        $this->assertCount($count , $comment->comments);
        $this->assertInstanceOf(Comment::class ,$comment->comments()->first());

    }
}
