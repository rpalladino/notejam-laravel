<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class SettingsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\User::class)->create([
            'password' => Hash::make('original-password')
        ]);
        $this->actingAs($this->user);
    }

    /**
     * User can successfully change settings
     *
     * @return void
     */
    public function testUserCanSuccessfullyChangeSettings()
    {
        $this->visit('/settings')
             ->type('original-password', 'current_password')
             ->type('new-password', 'new_password')
             ->type('new-password', 'new_password_confirmation')
             ->press('Save')
             ->see('Password is successfully changed')
             ->assertPasswordWasChanged();
    }

    public function testUserCantChangeSettingsIfRequiredFieldsMissing()
    {
        $this->visit('/settings')
             ->press('Save')
             ->see('The current password field is required')
             ->see('The new password field is required')
             ->see('The new password confirmation field is required');
    }

    /**
     * Assert that the user password was changed
     *
     * @param  App\User $user
     * @return void
     */
    private function assertPasswordWasChanged()
    {
        $oldPassword = $this->user->password;
        $user = App\User::where('email', $this->user->email)->first();
        $this->assertNotEquals($oldPassword, $user->password);
    }
}
