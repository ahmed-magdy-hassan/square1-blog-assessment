<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_admin_user_load_users_page()
    {
        $user = User::factory()->adminRole()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $this->actingAs($user)->get('/users')->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannot_author_user_load_users_page()
    {
        $user = User::factory()->authorRole()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $this->actingAs($user)->get('/users')->assertStatus(403);
    }
    /**
     * @test
     */
    public function cannot_admin_author_user_load_users_page()
    {
        $user = User::factory()->adminAuthorRole()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $this->actingAs($user)->get('/users')->assertStatus(403);
    }
}
