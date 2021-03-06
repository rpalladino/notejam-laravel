<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class SignInTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User can successfully sign in
     *
     * @return void
     */
    public function testUserCanSuccessfullySignIn()
    {
        $user = factory(App\User::class)->create([
            'email' => 'jsmith@example.com',
            'password' => Hash::make('secure-password')
        ]);

        $this->visit('/signin')
             ->type('jsmith@example.com', 'email')
             ->type('secure-password', 'password')
             ->press('Sign In')
             ->seeRouteIs('list-notes');
    }

    /**
     * User can't sign in if required fields are missing
     *
     * @return void
     */
    public function testUserCantSignInIfRequiredFieldsAreMissing()
    {
        $this->visit('/signin')
             ->press('Sign In')
             ->see('The email field is required')
             ->see('The password field is required')
             ->seeRouteIs('signin');
    }

    /**
     * User can't sign in if credentials are wrong
     *
     * @return void
     */
    public function testUserCantSignInIfCredentialsAreWrong()
    {
        $this->visit('/signin')
             ->type('jsmith@gmail.com', 'email')
             ->type('secure-password', 'password')
             ->press('Sign In')
             ->see('Wrong password or email')
             ->seeRouteIs('signin');
    }

    /**
     * User can successfully sign out
     *
     * @return void
     */
    public function testUserCanSuccessfullySignOut()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/signout')
             ->seeRouteIs('signin')
             ->see('You have signed out');
    }
}
