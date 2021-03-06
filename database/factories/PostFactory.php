<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(3);
    return [
        //
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->paragraph(3),
        'featured_image' => 'uploads/products/sample.JPG',
        'category_id' => '0',
        'user_id' => '0'  
    ];
});
