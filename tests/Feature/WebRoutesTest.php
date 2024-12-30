<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class WebRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_posts_index_page_is_accessible()
    {
        Post::factory()->create();
        $response = $this->get('/posts');
        $response->assertStatus(200);
    }

    public function test_post_show_page_is_accessible()
    {
        $post = Post::factory()->create();
        $response = $this->get("/posts/{$post->id}");
        $response->assertStatus(200);
    }

    public function test_categories_index_page_is_accessible()
    {
        Category::factory()->create();
        $response = $this->get('/categories');
        $response->assertStatus(200);
    }

    public function test_category_show_page_is_accessible()
    {
        $category = Category::factory()->create();
        $response = $this->get("/categories/{$category->id}");
        $response->assertStatus(200);
    }
}
