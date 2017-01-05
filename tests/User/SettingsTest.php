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

    /**
     * User can't change settings if required fields are missing
     *
     * @return void
     */
    public function testUserCantChangeSettingsIfRequiredFieldsMissing()
    {
        $this->visit('/settings')
             ->press('Save')
             ->see('The current password field is required')
             ->see('The new password field is required')
             ->see('The new password confirmation field is required');
    }

    /**
     * User can't change settings if current password is wrong
     *
     * @return void
     */
    public function testUserCantChangeSettingsIfCurrentPasswordIsWrong()
    {
        $this->visit('/settings')
             ->type('wrong-password', 'current_password')
             ->type('new-password', 'new_password')
             ->type('new-password', 'new_password_confirmation')
             ->press('Save')
             ->see('Invalid current password');
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
