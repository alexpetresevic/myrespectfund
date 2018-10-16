<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Page::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'body' => $faker->paragraph(12),
        'slug' => str_slug($title),
    ];
});
