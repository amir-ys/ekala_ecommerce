<?php

namespace Modules\Comment\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Comment\Models\Comment;
use Modules\RolePermissions\Database\Seeders\RolePermissionsSeeder;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.comments.index'));

        $response->assertViewIs('Comment::index')
            ->assertViewHas('parentComments' , Comment::query()->latest()->get());
    }
    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->seed(RolePermissionsSeeder::class);
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COMMENTS);
        $this->actingAs($user);
    }

    ##todo continue comment test
}
