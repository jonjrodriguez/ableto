<?php

namespace Tests\Unit;

use AbleTo\Answer;
use AbleTo\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_the_answers_for_a_user()
    {
        $user = factory(User::class)->create();
        factory(Answer::class, 4)->create(['user_id' => $user->id]);
        factory(Answer::class, 2)->create();

        $answers = Answer::forUser($user)->first();

        $this->assertCount(4, $answers);
    }

    /** @test */
    public function it_groups_the_answers_by_date()
    {
        $user = factory(User::class)->create();

        factory(Answer::class)->create(['user_id' => $user->id]);
        factory(Answer::class)->create([
            'user_id' => $user->id,
            'created_at' => Carbon::now()->subDays(2)
        ]);
        factory(Answer::class)->create([
            'user_id' => $user->id,
            'created_at' => Carbon::now()->subDays(4)
        ]);

        $answers = Answer::forUser($user);

        $this->assertCount(3, $answers);
    }


    /** @test */
    public function it_includes_the_question_for_a_user()
    {
        $user = factory(User::class)->create();
        factory(Answer::class)->create(['user_id' => $user->id]);

        $answer = Answer::forUser($user)->first();

        $this->assertArrayHasKey('question', $answer[0]);
    }

    /** @test */
    public function it_includes_the_option_for_a_user()
    {
        $user = factory(User::class)->create();
        factory(Answer::class)->create(['user_id' => $user->id]);

        $answer = Answer::forUser($user)->first();

        $this->assertArrayHasKey('option', $answer[0]);
    }

    /** @test */
    public function it_has_a_question()
    {
        $answer = new Answer();

        $this->assertInstanceOf(BelongsTo::class, $answer->question());
    }

    /** @test */
    public function it_has_an_option()
    {
        $answer = new Answer();

        $this->assertInstanceOf(BelongsTo::class, $answer->option());
    }

    /** @test */
    public function it_only_allows_question_id_and_option_id_to_be_assigned()
    {
        $answer = new Answer();
        $answer->fill([
            'id' => 1,
            'user_id' => 1,
            'question_id' => 1,
            'option_id' => 1
        ]);

        $this->assertArrayNotHasKey('id', $answer);
        $this->assertArrayNotHasKey('user_id', $answer);
    }
}
