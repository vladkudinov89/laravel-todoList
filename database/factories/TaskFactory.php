<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'status' => $faker->boolean
    ];
});
