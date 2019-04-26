<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use Faker\Generator as Faker;


Storage::disk('local')->delete(Storage::allFiles());

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'published_at' => $faker->dateTime($max = 'now')
    ];
});
