<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create();
        $this->actingAs($this->user);
    }

    /**
     * Pad can be successfully created
     *
     * @return void
     */
    public function testPadCanBeSuccessfullyCreated()
    {
        $this->visit('/pads/create')
             ->type('Recipes', 'name')
             ->press('Save')
             ->seeRouteIs('list-notes')
             ->see('Pad successfully created')
             ->seeInElement('.pads', 'Recipes')
             ->seeInDatabase('pads', ['name' => 'Recipes']);
    }

    /**
     * Pad can't be created if required fields missing
     */
    public function testPadCantBeCreatedIfRequiredFieldsMissing()
    {
        $this->visit('/pads/create')
             ->press('Save')
             ->see('The name field is required')
             ->seePageIs('/pads/create');
    }
}
