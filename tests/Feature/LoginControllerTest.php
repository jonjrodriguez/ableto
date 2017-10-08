<?php

namespace Tests\Feature;

use AbleTo\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', ['email' => $user->email, 'password' => 'secret']);

        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }

    /** @test */
    public function a_user_cannot_login_with_bad_credentials()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', ['email' => $user->email, 'password' => 'wrong']);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_email_is_required_to_login()
    {
        $response = $this->post('/login', ['password' => 'wrong']);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_password_is_required_to_login()
    {
        $response = $this->post('/login', ['email' => 'email@example.com']);

        $this->assertGuest();
        $response->assertRedirect()
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function a_user_can_logout()
    {
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->post("/logout");

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
