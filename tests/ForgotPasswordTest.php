<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ForgotPasswordTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSuccessfullyGenerateNewPassword()
    {
        $user = factory(App\User::class)->create();

        $this->visit('/forgot-password')
             ->type($user->email, 'email')
             ->press('Generate password')
             ->seeRouteIs('forgot-password')
             ->see('New password sent to your email')
             ->assertPasswordWasReset($user);
    }

    private function assertPasswordWasReset($user)
    {
        $oldPassword = $user->password;
        $user = App\User::where('email', $user->email)->first();
        $this->assertNotEquals($oldPassword, $user->password);
    }
}
