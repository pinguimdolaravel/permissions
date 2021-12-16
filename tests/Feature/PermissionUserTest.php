<?php

namespace Tests\Feature;

use App\Models\User;
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
}
