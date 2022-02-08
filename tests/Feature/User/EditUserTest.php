<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_admin_user_load_create_user_page()
    {
        $user = User::factory()->adminRole()->create();

        $edit_user = User::factory()->authorRole()->create();

        $this->actingAs($user)->get("/users/{$edit_user->id}/edit")->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannot_author_user_load_create_user_page()
    {
        $user = User::factory()->authorRole()->create();
        $edit_user = User::factory()->authorRole()->create();
        $this->actingAs($user)->get("/users/{$edit_user->id}/edit")->assertStatus(403);
    }

    /**
     * @test
     */
    public function cannot_admin_author_user_load_create_user_page()
    {
        $user = User::factory()->adminAuthorRole()->create();
        $edit_user = User::factory()->authorRole()->create();
        $this->actingAs($user)->get("/users/{$edit_user->id}/edit")->assertStatus(403);
    }

    /**
     * @test
     */
    public function can_admin_update_user()
    {
        $user = User::factory()->adminRole()->create();

        $edit_user = User::factory()->authorRole()->create();

        $response = $this->actingAs($user)->put("/users/{$edit_user->id}", [
            'name' => 'Ahmed Magdy Test',
            'email' => $edit_user->email,
            'role' => $edit_user->role,
        ]);

        $response->assertRedirect('/users');
    }

    /**
     * @test
     */
    public function cannot_author_update_user()
    {
        $user = User::factory()->authorRole()->create();

        $edit_user = User::factory()->authorRole()->create();

        $response = $this->actingAs($user)->put("/users/{$edit_user->id}", [
            'name' => 'Ahmed Magdy Test',
            'email' => $edit_user->email,
            'role' => $edit_user->role,
        ]);

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function cannot_admin_author_update_user()
    {
        $user = User::factory()->authorRole()->create();

        $edit_user = User::factory()->authorRole()->create();

        $response = $this->actingAs($user)->put("/users/{$edit_user->id}", [
            'name' => 'Ahmed Magdy Test',
            'email' => $edit_user->email,
            'role' => $edit_user->role,
        ]);

        $response->assertStatus(403);
    }
}
