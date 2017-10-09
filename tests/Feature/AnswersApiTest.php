<?php

namespace Tests\Feature;

use AbleTo\Answer;
use AbleTo\Option;
use AbleTo\Question;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswersApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_authentication()
    {
        $response = $this->getJson('api/answers');

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test */
    public function it_returns_the_authenticated_users_answers_grouped_by_date()
    {
        $user = $this->logIn();

        factory(Answer::class, 4)->create(['user_id' => $user->id]);

        $response = $this->getJson('api/answers');

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => ['*' => []]]);
        $this->assertCount(1, $response->json()['data']);
        $this->assertCount(4, $response->json()['data'][Carbon::now()->format('Y-m-d')]);
    }

    /** @test */
    public function it_stores_answers_to_a_survey()
    {
        $user = $this->logIn();
        $option = factory(Option::class)->create();

        $response = $this->postJson('api/answers', [
            ['question_id' => $option->question->id, 'option_id' => $option->id]
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('answers', [
            'user_id' => $user->id,
            'question_id' => $option->question->id,
            'option_id' => $option->id
        ]);
    }

    /** @test */
    public function it_gets_the_answers_for_a_user_by_day()
    {
        $user = $this->logIn();
        factory(Answer::class, 3)->create(['user_id' => $user->id]);

        $today = Carbon::now()->format('Y-m-d');
        $response = $this->getJson("api/answers/{$today}");

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => ['*' => []]]);
        $this->assertCount(3, $response->json()['data']);

    }

    /** @test */
    public function it_returns_a_message_if_invalid_date()
    {
        $this->logIn();

        $response = $this->getJson('api/answers/notadate');

        $response->assertStatus(422)
            ->assertJsonStructure(['error']);
    }

    /** @test */
    public function it_must_have_a_valid_question_id()
    {
        $this->logIn();
        $option = factory(Option::class)->create();

        $response = $this->postJson('api/answers', [
            ['question_id' => 999, 'option_id' => $option->id]
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure(["message", "errors"]);
    }

    /** @test */
    public function it_must_have_a_valid_option_id()
    {
        $this->logIn();
        $question = factory(Question::class)->create();

        $response = $this->postJson('api/answers', [
            ['question_id' => $question->id, 'option_id' => 1]
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure(["message", "errors"]);
    }
}
