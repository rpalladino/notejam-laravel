<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditPadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Pad can be edited by its owner
     *
     * @return void
     */
    public function testNoteCanBeEditedByItsOwner()
    {
        $owner = factory(App\User::class)->create();
        $pad = factory(App\Pad::class)->create([
            'user_id' => $owner->id
        ]);

        $this->actingAs($owner)
             ->visit("/pads/{$pad->id}/edit")
             ->seeInField('name', $pad->name)
             ->type('Recipes', 'name')
             ->press('Save')
             ->seeRouteIs('all_notes')
             ->seeInElement('.alert-success', 'Pad is successfully updated')
             ->seeInElement('.pads', 'Recipes')
             ->seeInDatabase('pads', ['name' => 'Recipes']);
    }
}
