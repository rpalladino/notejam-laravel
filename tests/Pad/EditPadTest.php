<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditPadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->owner = factory(App\User::class)->create();
        $this->pad = factory(App\Pad::class)->create([
            'user_id' => $this->owner->id
        ]);
    }

    /**
     * Pad can be edited by its owner
     *
     * @return void
     */
    public function testNoteCanBeEditedByItsOwner()
    {
        $this->actingAs($this->owner)
             ->visit("/pads/{$this->pad->id}/edit")
             ->seeInField('name', $this->pad->name)
             ->type('Recipes', 'name')
             ->press('Save')
             ->seeRouteIs('all_notes')
             ->seeInElement('.alert-success', 'Pad is successfully updated')
             ->seeInElement('.pads', 'Recipes')
             ->seeInDatabase('pads', ['name' => 'Recipes']);
    }

    /**
     * Pad can't be edited if required fields missing
     */
    public function testPadCantBeEditedIfRequiredFieldsMissing()
    {
        $this->actingAs($this->owner)
             ->visit("/pads/{$this->pad->id}/edit")
             ->type('', 'name')
             ->press('Save')
             ->see('The name field is required')
             ->seePageIs("/pads/{$this->pad->id}/edit");
    }
}
