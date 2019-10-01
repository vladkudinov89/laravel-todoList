<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'is_complete' => $faker->boolean
    ];
});
