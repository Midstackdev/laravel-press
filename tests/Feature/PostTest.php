<?php

namespace Midstackdev\Press\Tests\Feature;

use Midstackdev\Press\MarkdownParser;
use Midstackdev\Press\Post;
use Midstackdev\Press\Tests\TestCase;

class PostTest extends TestCase
{
    public function test_a_post_can_be_created_with_the_factory()
    {
        $post = factory(Post::class)->create();

        $this->assertCount(1, Post::all());
    }
}