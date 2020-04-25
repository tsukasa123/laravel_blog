<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\User;
use App\Category;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(3);
    return [
        //
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->paragraph(3),
        'featured_image' => 'sample.jpg',
        'category_id' => $category->id,
        'user_id' => $user->id
        
    ];
});
