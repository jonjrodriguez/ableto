<?php

use AbleTo\Answer;
use AbleTo\Question;
use AbleTo\User;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::with('options')->get();
        $users = User::take(10)->get();

        foreach ($users as $user) {
            for ($i = 1; $i < 10; $i++) {
                $date = \Carbon\Carbon::now()->subDays($i);

                $questions->each(function ($question) use ($user, $date, $i) {
                    factory(Answer::class)->create([
                    'user_id' => $user->id,
                    'question_id' => $question->id,
                    'option_id' => $question->options[$i % 3]->id,
                    'created_at' => $date
                    ]);
                });
            }
        }
    }
}
