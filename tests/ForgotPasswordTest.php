<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ForgotPasswordTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User can successfully generate a new password if they've forgotten it
     *
     * @return void
     */
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


    /**
     * User can't generate new password if required email field is missing
     *
     * @return void
     */
    public function testUserCantGeneratePasswordIfRequiredEmailIsMising()
    {
        $this->visit('/forgot-password')
             ->press('Generate password')
             ->seeRouteIs('forgot-password')
             ->see('The email field is required');
    }


    private function assertPasswordWasReset($user)
    {
        $oldPassword = $user->password;
        $user = App\User::where('email', $user->email)->first();
        $this->assertNotEquals($oldPassword, $user->password);
    }
}
