<?php

use AbleTo\Option;
use AbleTo\Question;
use AbleTo\User;
use Faker\Generator as Faker;

$factory->define(AbleTo\Answer::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'question_id' => function() {
            return factory(Question::class)->create()->id;
        },
        'option_id' => function() {
            return factory(Option::class)->create()->id;
        }
    ];
});
