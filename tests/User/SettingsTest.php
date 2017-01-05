<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class SettingsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User can successfully change settings
     *
     * @return void
     */
    public function testUserCanSuccessfullyChangeSettings()
    {
        $user = factory(App\User::class)->create([
            'password' => Hash::make('original-password')
        ]);

        $this->actingAs($user)
             ->visit('/settings')
             ->type('original-password', 'current_password')
             ->type('new-password', 'new_password')
             ->type('new-password', 'new_password_confirmation')
             ->press('Save')
             ->see('Password is successfully changed')
             ->assertPasswordWasChanged($user);
    }

    /**
     * Assert that the user password was changed
     *
     * @param  App\User $user
     * @return void
     */
    private function assertPasswordWasChanged(App\User $user)
    {
        $oldPassword = $user->password;
        $user = App\User::where('email', $user->email)->first();
        $this->assertNotEquals($oldPassword, $user->password);
    }
}
