<?php

namespace Modules\Comment\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Post;
use Modules\Comment\Models\Comment;
use Modules\Product\Models\Product;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $table = 'comments' ;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.comments.index'));

        $response->assertViewIs('Comment::index')
            ->assertViewHas('parentComments' , Comment::query()->latest()->get());
    }

    public function test_product_comments_index()
    {
        $this->actingAsUser();

        $this->get(route('panel.comments.blogIndex'))
            ->assertViewIs('Comment::index')
            ->assertViewHas('parentComments' , Comment::query()->whereMorphedTo('commentable' , Product::class)->get());
    }

    public function test_blog_comments_index()
    {
        $this->actingAsUser();

        $this->get(route('panel.comments.productIndex'))
            ->assertViewIs('Comment::index')
            ->assertViewHas('parentComments' , Comment::query()->whereMorphedTo('commentable' , Post::class)->get());
    }

    public function test_store_method()
    {
        $this->actingAsUser();
        $data = Comment::factory()->make(['user_id' => auth()->id() , 'is_approved' => 1 , 'is_seen' => 1])->toArray();

        $this->post(route('comments.store') , $data);

        $this->assertDatabaseCount($this->table , 1);
        $this->assertDatabaseHas($this->table , $data);

    }

    public function test_user_can_approve_comment_status()
    {
        $this->actingAsUser();
        $comment = Comment::factory()->create(['is_approved' => 0 ]);

        $this->patchJson(route('panel.comments.approveStatus' , $comment->id));

        $this->assertDatabaseCount($this->table , 1);
        $this->assertDatabaseHas($this->table , ['is_approved' => Comment::STATUS_APPROVED]);
    }

    public function test_user_can_reject_comment_status()
    {
        $this->actingAsUser();
        $comment = Comment::factory()->create(['is_approved' => 1 ]);

        $this->patchJson(route('panel.comments.rejectStatus' , $comment->id));

        $this->assertDatabaseCount($this->table , 1);
        $this->assertDatabaseHas($this->table , ['is_approved' => Comment::STATUS_REJECTED]);
    }

    public function test_user_can_change_seen_in_comment()
    {
        $this->actingAsUser();
        $comment = Comment::factory()->create(['is_seen' => Comment::NOT_SEEN ]);

        $this->patchJson(route('panel.comments.changeSeenStatus' , $comment->id));

        $this->assertDatabaseCount($this->table , 1);
        $this->assertDatabaseHas($this->table , ['is_seen' => Comment::SEEN]);
    }

    public function test_user_can_see_replay_comment_page()
    {
        $this->actingAsUser();
        $comment = Comment::factory()->create();
        $response = $this->get(route('panel.comments.replies.show' , $comment->id));

        $response->assertViewIs('Comment::reply')
            ->assertViewHas('comment' , Comment::query()->first());
    }

    public function actingAsUser()
    {
        $user = User::factory()->admin()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COMMENTS);
        $this->actingAs($user);
    }

    ##todo continue comment test
}
