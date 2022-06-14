<?php

namespace Modules\Comment\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Comment\Models\Comment;
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
}
