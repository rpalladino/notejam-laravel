<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Pad can be successfully created
     *
     * @return void
     */
    public function testPadCanBeSuccessfullyCreated()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/pad/create')
             ->type('Personal', 'name')
             ->press('Save')
             ->seeRouteIs('all_notes')
             ->see('Pad successfully created')
             ->seeInElement('.pads', 'Personal')
             ->seeInDatabase('pads', ['name' => 'Personal']);
    }
}
