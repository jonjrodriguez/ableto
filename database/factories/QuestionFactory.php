<?php

use Faker\Generator as Faker;

$factory->define(AbleTo\Question::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence(10)
    ];
});
