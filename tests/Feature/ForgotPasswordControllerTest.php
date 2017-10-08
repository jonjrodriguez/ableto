<?php

namespace Tests\Feature;

use AbleTo\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_send_a_password_reset()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this->post('/password/email', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
        $response->assertRedirect()
            ->assertSessionHas("status", "We have e-mailed your password reset link!");
    }

    /** @test */
    public function it_doesnt_send_reset_to_invalid_user()
    {
        Notification::fake();

        $response = $this->post('/password/email', ['email' => "nope@example.com"]);

        Notification::assertNothingSent();
        $response->assertRedirect()
            ->assertSessionHasErrors("email");
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->post('/password/email');

        $response->assertRedirect()
            ->assertSessionHasErrors('email');
    }
}
