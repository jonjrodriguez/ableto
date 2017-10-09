<?php

namespace Tests\Feature;

use AbleTo\Option;
use AbleTo\Question;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionsApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_authentication()
    {
        $response = $this->getJson('api/questions');

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test */
    public function it_gets_a_list_of_questions()
    {
        $this->logIn();

        factory(Question::class, 5)->create();

        $response = $this->getJson('api/questions');

        $response->assertSuccessful()
            ->assertJsonStructure(['data']);
        $this->assertCount(5, $response->json()['data']);
    }

    /** @test */
    public function it_includes_the_options_with_the_questions()
    {
        $this->logIn();

        factory(Option::class, 5)->create();

        $response = $this->getJson('api/questions');

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => [
                '*' => ['options']
            ]]);
    }


}
