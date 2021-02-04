<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CastMember;
use Faker\Generator as Faker;

$factory->define(CastMember::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => array_rand([CastMember::TYPE_ACTOR, CastMember::TYPE_DIRECTOR]),
        'description' => $faker->text
    ];
});