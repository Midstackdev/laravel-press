<?php

namespace Midstackdev\Press\Repositories;

use Illuminate\Support\Arr;
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
            'extra' => $this->extra($post),
        ]);
    } 

    private function extra($post)
    {
        $extra = (array) json_decode($post['extra'] ?? '[]');
        $attributes = Arr::except($post, ['title', 'body', 'slug', 'identifier', 'extra']);

        return json_encode(array_merge($extra, $attributes));
    }
}