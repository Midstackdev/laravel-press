<?php

namespace Midstackdev\Press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Midstackdev\Press\Post;
use Midstackdev\Press\PressFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (is_null(config('press'))) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        $files = File::files(config('press.path'));

        foreach ($files as $file) {
            $post = (new PressFileParser($file->getPathname()))->getData();

        }
        // dd($post);

        Post::create([
            'identifier' => Str::random(),
            'title' => $post['title'],
            'slug' => Str::slug($post['title']),
            'body' => $post['body'],
            'extra' => $post['extra'] ?? []
        ]);
    }
}