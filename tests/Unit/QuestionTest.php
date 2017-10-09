<?php

namespace Tests\Unit;

use AbleTo\Question;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    /** @test */
    public function it_only_allows_the_text_to_be_mass_assigned()
    {
        $question = new Question();
        $question->fill([
            'id' => 100,
            'text' => 'Text'
        ]);

        $this->assertArrayNotHasKey('id', $question);
    }

    /** @test */
    public function it_has_many_options()
    {
        $question = new Question();

        $this->assertInstanceOf(HasMany::class, $question->options());
    }
}
