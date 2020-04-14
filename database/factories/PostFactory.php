<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Midstackdev\Press\Post;


$factory->define(Post::class, function (Faker $faker) {
    return [
        'identifier' => Str::random(),
        'title' => $title = $faker->sentence,
        'slug' => Str::slug($title),
        'body' => $faker->paragraph,
        'extra' => json_encode(['test' => 'value']),
    ];
});