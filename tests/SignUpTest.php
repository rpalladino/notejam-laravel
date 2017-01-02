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
             ->type('a-bad-password', 'password_confirmation')
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
             ->see('The password confirmation field is required')
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
             ->type('a-bad-password', 'password_confirmation')
             ->press('Sign Up')
             ->see('The email must be a valid email address')
             ->userWasNotCreated();
    }

    /**
     * User can't sign up if email already exists
     */
    public function testUserCantSignupIfEmailAlreadyExists()
    {
        $user = factory(App\User::class)->create([
            'email' => 'jsmith@example.com',
        ]);

        $this->visit('/signup')
             ->type('jsmith@example.com', 'email')
             ->type('a-bad-password', 'password')
             ->type('a-bad-password', 'password_confirmation')
             ->press('Sign Up')
             ->see('The email has already been taken')
             ->userWasNotCreated(1);
    }

    /**
     * User can't sign up if passwords do not match
     *
     * @return void
     */
    public function testUserCantSignUpIfPasswordsDoNotMatch()
    {
        $this->visit('/signup')
             ->type('jsmith@example.com', 'email')
             ->type('a-secure-password', 'password')
             ->type('a-mismatched-password', 'password_confirmation')
             ->press('Sign Up')
             ->see('The password confirmation does not match')
             ->userWasNotCreated();
    }

    /**
     * Verify that a user was not created in the database
     *
     * @param $existing The number of any existing users
     * @return void
     */
    protected function userWasNotCreated($existing = 0)
    {
        $this->assertEquals($existing, App\User::all()->count());
    }
}
