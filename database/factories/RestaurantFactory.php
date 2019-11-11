<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'name' => $faker->company,
        'location' => $faker->streetAddress,
        'image' => $faker->imageUrl(640, 480, 'food'),
        'user_id' => $faker->randomElement($users),
    ];
});
