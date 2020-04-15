<?php

namespace Midstackdev\Press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Midstackdev\Press\Facades\Press;
use Midstackdev\Press\Post;


class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }


        try {
            $posts = Press::driver()->fetchPosts();

        
            // dd($posts);
        
            foreach ($posts as $post) {
                Post::insert([
                    'identifier' => $post['identifier'],
                    'title' => $post['title'],
                    'slug' => Str::slug($post['title']),
                    'body' => $post['body'],
                    'extra' => $post['extra'] ?? []
                ]);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}