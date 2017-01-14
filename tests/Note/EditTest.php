<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Note;

class EditTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * The user who owns the note.
     * @var User
     */
    private $owner;

    /**
     * The note being edited.
     * @var Note
     */
    private $note;

    public function setUp()
    {
        parent::setUp();
        $this->owner = factory(User::class)->create();
        $this->note = factory(Note::class)->create([
            'user_id' => $this->owner->id
        ]);
    }

    /**
     * Note can be edited by its owner
     *
     * @return void
     */
    public function testNoteCanBeEditedByItsOwner()
    {
        $this->actingAs($this->owner)
             ->visit("/notes/{$this->note->id}")
             ->click('Edit')
             ->seePageIs("/notes/{$this->note->id}/edit")
             ->see($this->note->name)
             ->see($this->note->text)
             ->type('New name', 'name')
             ->type('New text', 'text')
             ->press('Save')
             ->seePageIs("/notes/{$this->note->id}")
             ->see('Note is successfully updated')
             ->see('New name')
             ->see('New text');
    }
}
