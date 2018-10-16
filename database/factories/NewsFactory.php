<?php

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'body' => $faker->paragraph(15),
        'slug' => str_slug($title),
    ];
});
