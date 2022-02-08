<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_user_load_posts_page_after_login()
    {
        $user = User::factory()->adminRole()->create();
        $this->actingAs($user)->get('/posts')->assertStatus(200)->assertSeeLivewire('web.posts.index');
    }

    /**
     * @test
     */
    public function cannot_guest_load_posts_page()
    {
        $this->get('/posts')->assertRedirect('login');
    }
    /**
     * @test
     */
    public function can_guest_load_published_posts()
    {
        $published_post = Post::factory()->published()->create();
        $unpublished_post = Post::factory()->unPublished()->create();

        $this->get('/')
            ->assertStatus(200)
            ->assertSeeLivewire('guest.posts.index')
            ->assertSeeText($published_post->title);
    }

    /**
     * @test
     */
    public function cannot_guest_load_unpublished_posts()
    {
        $published_post = Post::factory()->published()->create();
        $unpublished_post = Post::factory()->unPublished()->create();

        $this->get('/')
            ->assertStatus(200)
            ->assertSeeLivewire('guest.posts.index')
            ->assertDontSee($unpublished_post->title);
    }

    /**
     * @test
     */
    public function can_user_load_only_his_posts_after_login()
    {
        $user = User::factory()->adminRole()->create();

        $first_published_post = Post::factory([
            'user_id' => $user->id
        ])->published()->create();

        $second_published_post = Post::factory([
            'user_id' => User::factory()->create()
        ])->published()->create();

        $this->actingAs($user)
            ->get('/posts')
            ->assertStatus(200)
            ->assertSeeLivewire('web.posts.index')
            ->assertSeeText($first_published_post->title)
            ->assertDontSee($second_published_post->title);
    }

    /**
     * @test
     */
    public function can_user_load_his_published_and_unpublished_posts_after_login()
    {
        $user = User::factory()->adminRole()->create();

        $published_post = Post::factory([
            'user_id' => $user->id
        ])->published()->create();

        $unpublished_post = Post::factory([
            'user_id' => $user->id
        ])->unPublished()->create();

        $this->actingAs($user)
            ->get('/posts')
            ->assertStatus(200)
            ->assertSeeLivewire('web.posts.index')
            ->assertSeeText($published_post->title)
            ->assertSeeText($unpublished_post->title);
    }
}
