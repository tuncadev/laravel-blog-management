<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Post;

class ExampleUnitTest extends TestCase
{
    public function test_post_has_title()
    {
        $post = new Post(['title' => 'Test Title']);
        $this->assertEquals('Test Title', $post->title);
    }
}
