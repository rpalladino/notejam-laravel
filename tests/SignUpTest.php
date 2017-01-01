<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignUpTest extends TestCase
{
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
             ->type('a-bad-password', 'confirm-password')
             ->press('Sign Up')
             ->see('Account successfully created!')
             ->seeInDatabase('users', [
                 'email' => 'jsmith@example.com'
             ]);
    }
}
