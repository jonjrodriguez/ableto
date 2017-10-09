<?php

namespace Tests\Unit;

use AbleTo\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_has_many_answers()
    {
        $user = new User();

        $this->assertInstanceOf(HasMany::class, $user->answers());
    }
}
