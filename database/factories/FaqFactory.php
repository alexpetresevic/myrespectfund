<?php

use App\Faq;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence,
        'answer' => $faker->paragraph(rand(5, 15)),
    ];
});
