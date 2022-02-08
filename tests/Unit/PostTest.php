<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function post_has_short_description_char()
    {
        $post = Post::factory([
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe enim quae quia natus, nobis doloremque suscipit voluptatibus ducimus magnam temporibus?'
        ])
            ->published()
            ->make();

        $this->assertEquals(
            'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe enim quae quia natus, nobis doloremq...',
            $post->short_description
        );
    }

    /**
     * @test
     */
    public function post_with_publication_date_are_published()
    {
        $first_post = Post::factory()->published()->create();
        $second_post = Post::factory()->published()->create();
        $third_post = Post::factory()->unPublished()->create();

        $published_posts = Post::published()->get();

        $this->assertTrue($published_posts->contains($first_post));
        $this->assertTrue($published_posts->contains($second_post));
        $this->assertFalse($published_posts->contains($third_post));
    }
}
