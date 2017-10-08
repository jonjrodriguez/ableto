<?php

namespace Tests\Feature;

use AbleTo\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_reset_password()
    {
        $user = factory(User::class)->create();
        $token = $this->app->make('auth.password.broker')->createToken($user);

        $user = $user->toArray();
        $user['token'] = $token;
        $user['password'] = 'password';
        $user['password_confirmation'] = 'password';

        $response = $this->post('/password/reset', $user);

        $this->assertCredentials(['email' => $user['email'], 'password' => 'password']);
        $this->assertAuthenticated();
        $response->assertRedirect('/')
            ->assertSessionHas("status", "Your password has been reset!");
    }

    /** @test */
    public function it_needs_a_valid_token()
    {
        $user = factory(User::class)->create()->toArray();
        $user['token'] = 'asdf';
        $user['password'] = 'password';
        $user['password_confirmation'] = 'password';

        $response = $this->post('/password/reset', $user);

        $this->assertCredentials(['email' => $user['email'], 'password' => 'secret']);
        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors("email");
    }

    /** @test */
    public function it_needs_an_email()
    {
        $user = factory(User::class)->create()->toArray();
        unset($user['email']);
        $user['password'] = 'password';
        $user['password_confirmation'] = 'password';

        $response = $this->post('/password/reset', $user);

        $response->assertRedirect()
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_needs_a_password()
    {
        $user = factory(User::class)->create()->toArray();
        $user['password_confirmation'] = 'password';

        $response = $this->post('/password/reset', $user);

        $response->assertRedirect()
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_needs_a_password_confirmation()
    {
        $user = factory(User::class)->create()->toArray();
        $user['password'] = 'password';

        $response = $this->post('/password/reset', $user);

        $response->assertRedirect()
            ->assertSessionHasErrors("password" );
    }
}
