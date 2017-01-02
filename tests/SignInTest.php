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
             ->seeRouteIs('all_notes');
    }
}
