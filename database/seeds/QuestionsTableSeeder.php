<?php

use AbleTo\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            'How do you feel today?' => [
                'Great', 'Angry', 'Sad'
            ],
            'What did you do today?' => [
              'Take a walk', 'Stay inside', 'Sleep'
            ],
            'What did you eat today for breakfast?' => [
                'Eggs', 'Cereal', 'Toast'
            ]
        ];

        foreach ($questions as $text => $options) {
            $question = Question::create([
                'text' => $text
            ]);

            foreach ($options as $option) {
                $question->options()->create(['text' => $option]);
            }
        }
    }
}
