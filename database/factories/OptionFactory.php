<?php

use Faker\Generator as Faker;

$factory->define(AbleTo\Option::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence(2, true),
        'question_id' => function() {
            return factory(\AbleTo\Question::class)->create()->id;
        }
    ];
});
