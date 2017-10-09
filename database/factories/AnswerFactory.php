<?php

use AbleTo\Option;
use AbleTo\Question;
use AbleTo\User;
use Faker\Generator as Faker;

$factory->define(AbleTo\Answer::class, function (Faker $faker) {
    $question = factory(Question::class)->create();
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'question_id' => $question->id,
        'option_id' => function() use ($question) {
            return factory(Option::class)->create(['question_id' => $question->id])->id;
        }
    ];
});
