<?php

namespace Tests;

use AbleTo\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function logIn(User $user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        return $user;
    }
}
