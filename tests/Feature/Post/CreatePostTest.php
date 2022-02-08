<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_user_load_create_post_page()
    {
        $user = User::factory()->authorRole()->create();
        $this->actingAs($user)->get('/posts/create')->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannot_guest_load_create_post_page()
    {
        $this->get('/posts/create')->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function can_user_store_new_post()
    {
        $user = User::factory()->authorRole()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Post Title',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, nihil!',
            'publication_date' => now(),
        ]);

        $response->assertRedirect('/posts');
    }

    /**
     * @test
     */
    public function cannot_guest_store_new_post()
    {
        $response = $this->post('/users', [
            'title' => 'Post Title',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, nihil!',
            'publication_date' => now(),
        ]);

        $response->assertRedirect('/login');
    }
}
