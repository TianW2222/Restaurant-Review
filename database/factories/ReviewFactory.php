<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    $users = \App\User::pluck('id')->toArray();
    $restaurants = \App\Restaurant::pluck('id')->toArray();
    return [
        'title' => $faker->sentence(4, true),
        'body' => $faker->paragraph(3, true),
        'rating' => $faker->numberBetween(1, 10),
        'user_id' => $faker->randomElement($users),
        'restaurant_id' => $faker->randomElement($restaurants),
    ];
});
