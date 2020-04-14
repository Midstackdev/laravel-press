<?php

namespace Midstackdev\Press\Tests\Feature;

use Midstackdev\Press\MarkdownParser;
use Midstackdev\Press\Tests\TestCase;
use Parsedown;

class MarkdownTest extends TestCase
{
    public function test_simple_markdown_is_parsed()
    {
        $this->assertEquals('<h1>Heading</h1>', MarkdownParser::parse('# Heading'));
    }
}