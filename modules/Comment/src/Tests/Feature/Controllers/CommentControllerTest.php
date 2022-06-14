<?php

namespace Modules\Comment\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Comment\Models\Comment;
use Modules\User\Models\User;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $response = $this->get(route('panel.comments.index'));

        $response->assertViewIs('Comment::index')
            ->assertViewHas('comments' , Comment::query()->latest()->get());
    }

    public function actingAsUser()
    {
        $user =  User::factory()->create();
        $this->actingAs($user);
    }
}
