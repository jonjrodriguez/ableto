<?php

namespace Tests\Feature;

use AbleTo\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_register_an_account()
    {
        $user = factory(User::class)->make()->toArray();
        $user['password'] = "password";
        $user['password_confirmation'] = "password";

        $response = $this->post('/register', $user);

        $this->isAuthenticated();
        $response->assertRedirect('/');
    }

    /** @test */
    public function a_name_is_required_when_registering()
    {
        $user = factory(User::class)->make(['name' => null])->toArray();
        $user['password'] = "password";
        $user['password_confirmation'] = "password";

        $response = $this->post('/register', $user);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_email_is_required_when_registering()
    {
        $user = factory(User::class)->make(['email' => null])->toArray();
        $user['password'] = "password";
        $user['password_confirmation'] = "password";

        $response = $this->post('/register', $user);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_password_is_required_when_registering()
    {
        $user = factory(User::class)->make(['email' => null])->toArray();
        $user['password'] = "password";

        $response = $this->post('/register', $user);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function a_password_confirmation_is_required_when_registering()
    {
        $user = factory(User::class)->make(['email' => null])->toArray();
        $user['password'] = "password";

        $response = $this->post('/register', $user);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('password');
    }
}
