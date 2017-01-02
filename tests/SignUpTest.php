<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignUpTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User can successfully sign up
     *
     * @return void
     */
    public function testUserCanSignUp()
    {
        $this->visit('/signup')
             ->see('Sign Up')
             ->type('jsmith@example.com', 'email')
             ->type('a-bad-password', 'password')
             ->type('a-bad-password', 'confirm_password')
             ->press('Sign Up')
             ->see('Account successfully created!')
             ->seeInDatabase('users', [
                 'email' => 'jsmith@example.com'
             ]);
    }

    /**
     * User can't sign up if required fields are missing
     *
     * @return void
     */
    public function testUserCantSignUpIfRequiredFieldsAreMissing()
    {
        $this->visit('/signup')
             ->press('Sign Up')
             ->see('The email field is required')
             ->see('The password field is required')
             ->see('The confirm password field is required')
             ->userWasNotCreated();

    }

    protected function userWasNotCreated()
    {
        $this->assertEquals(0, App\User::all()->count());
    }
}
