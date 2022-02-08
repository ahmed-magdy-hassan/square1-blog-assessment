<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_admin_user_load_create_user_page()
    {
        $user = User::factory()->adminRole()->create();
        $this->actingAs($user)->get('/users/create')->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannot_author_user_load_create_user_page()
    {
        $user = User::factory()->authorRole()->create();
        $this->actingAs($user)->get('/users')->assertStatus(403);
    }

    /**
     * @test
     */
    public function cannot_admin_author_user_load_create_user_page()
    {
        $user = User::factory()->adminAuthorRole()->create();
        $this->actingAs($user)->get('/users')->assertStatus(403);
    }

    /**
     * @test
     */
    public function can_admin_store_new_user()
    {
        $user = User::factory()->adminRole()->create();

        $response = $this->actingAs($user)->post('/users', [
            'name' => 'Ahmed Magdy',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => User::ROLE_ADMIN_AUTHOR
        ]);

        $response->assertRedirect('/users');
    }

    /**
     * @test
     */
    public function cannot_author_store_new_user()
    {
        $user = User::factory()->authorRole()->create();

        $response = $this->actingAs($user)->post('/users', [
            'name' => 'Ahmed Magdy',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => User::ROLE_ADMIN_AUTHOR
        ]);

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function cannot_admin_author_store_new_user()
    {
        $user = User::factory()->authorRole()->create();

        $response = $this->actingAs($user)->post('/users', [
            'name' => 'Ahmed Magdy',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => User::ROLE_ADMIN_AUTHOR
        ]);

        $response->assertStatus(403);
    }
}
