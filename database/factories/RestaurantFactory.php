<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'name' => $faker->company,
        'location' => $faker->streetAddress,
        'image' => '/storage/images/foodimage' . mt_rand(1,8) . '.jpeg',
        'user_id' => $faker->randomElement($users),
    ];
});
