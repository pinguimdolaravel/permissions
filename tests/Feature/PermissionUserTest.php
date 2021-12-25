<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PermissionUserTest extends TestCase
{
    /** @test */
    public function it_should_be_able_to_give_a_permission_to_an_user()
    {
        /** @var User $user */
        $user = User::factory()->createOne();

        $user->givePermissionTo('edit-articles');

        $this->assertTrue($user->hasPermissionTo('edit-articles'));
        $this->assertDatabaseHas('permissions', [
            'permission' => 'edit-articles',
        ]);
    }

    /** @test */
    public function it_should_be_able_to_authorize_access_to_a_route_based_on_the_permission()
    {
        Route::get('test-something-weird', function () {
            return 'test';
        })->middleware('permission:edit-articles');

        /** @var User $user */
        $user = User::factory()->createOne();

        $this->actingAs($user)
            ->get('test-something-weird')
            ->assertForbidden();

        $user->givePermissionTo('edit-articles');
        $this->actingAs($user)
            ->get('test-something-weird')
            ->assertSuccessful();
    }

    /** @test */
    public function it_should_be_able_to_use_policies_with_my_permissions()
    {
        /** @var User $user */
        $user = User::factory()->createOne();
        $post = $user->posts()->save(Post::factory()->make());

        /** @var User $user2 */
        $user2 = User::factory()->createOne();
        $this->actingAs($user2)
            ->delete(route('posts.destroy', $post))
            ->assertForbidden();
    }

    /** @test */
    public function the_list_of_permissions_should_be_cached()
    {
        Permission::query()->create(['permission' => 'edit-articles']);

        $fromCache = Cache::get('permissions');
        $this->assertCount(1, $fromCache);
    }
}
