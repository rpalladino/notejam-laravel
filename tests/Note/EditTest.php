<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Note can be edited by its owner
     *
     * @return void
     */
    public function testNoteCanBeEditedByItsOwner()
    {
        $owner = factory(App\User::class)->create();
        $note = factory(App\Note::class)->create([
            'user_id' => $owner->id
        ]);

        $this->actingAs($owner)
             ->visit("/notes/{$note->id}")
             ->click('Edit')
             ->seePageIs("/notes/{$note->id}/edit")
             ->see($note->name)
             ->see($note->text)
             ->type('New name', 'name')
             ->type('New text', 'text')
             ->press('Save')
             ->seePageIs("/notes/{$note->id}")
             ->see('Note is successfully updated')
             ->see('New name')
             ->see('New text');
    }
}
