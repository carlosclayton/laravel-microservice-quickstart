<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->sentence ,
        'year_launched' => $faker->year,
        'opened' => $faker->boolean,
        'duration' => rand(0,240),
        'rating' => array_rand(Video::RATING_LIST)
    ];
});
