<?php

namespace Tests\Unit;

use AbleTo\Option;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class OptionTest extends TestCase
{
    /** @test */
    public function it_only_allows_the_text_to_be_mass_assigned()
    {
        $option = new Option();
        $option->fill([
            'id' => 100,
            'question_id' => 10,
            'text' => 'Text'
        ]);

        $this->assertArrayNotHasKey('id', $option);
        $this->assertArrayNotHasKey('user_id', $option);
    }

    /** @test */
    public function it_has_many_options()
    {
        $option = new Option();

        $this->assertInstanceOf(BelongsTo::class, $option->question());
    }
}
