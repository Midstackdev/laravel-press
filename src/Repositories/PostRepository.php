<?php

namespace Midstackdev\Press\Repositories;

use Illuminate\Support\Str;
use Midstackdev\Press\Post;


class PostRepository
{
    public function save($post)
    {
        Post::updateOrCreate([

            'identifier' => $post['identifier'],
        ],[
            'title' => $post['title'],
            'slug' => Str::slug($post['title']),
            'body' => $post['body'],
            'extra' => $post['extra'] ?? json_encode([])
        ]);
    } 
}