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

    /**
     * User can't sign up if email is invalid
     *
     * @return void
     */
    public function testUserCantSignUpIfEmailIsInvalid()
    {
        $this->visit('/signup')
             ->type('jsmith', 'email')
             ->type('a-bad-password', 'password')
             ->type('a-bad-password', 'confirm_password')
             ->press('Sign Up')
             ->see('The email must be a valid email address')
             ->userWasNotCreated();
    }

    /**
     * Verify that a user was not created in the database
     *
     * @return void
     */
    protected function userWasNotCreated()
    {
        $this->assertEquals(0, App\User::all()->count());
    }
}
