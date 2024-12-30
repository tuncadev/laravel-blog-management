<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class ApiRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_posts_list()
    {
        Post::factory(3)->create();
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_api_post_details()
    {
        $post = Post::factory()->create();
        $response = $this->getJson("/api/posts/{$post->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $post->id]);
    }

    public function test_api_post_add_comment()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson("/api/posts/{$post->id}/comments", [
            'content' => 'This is a test comment.',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['content' => 'This is a test comment.']);
    }

    public function test_api_login_and_get_token()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    public function test_protected_api_requires_authentication()
    {
        $response = $this->postJson('/api/posts/1/comments', ['content' => 'Unauthorized']);
        $response->assertStatus(401); // Unauthorized
    }
}
