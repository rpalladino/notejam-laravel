<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
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

    /**
     * Note can't be edited if required fields are missing
     *
     * @return void
     */
    public function testNoteCantBeEditedIfRequiredFieldsAreMissing()
    {
        $this->actingAs($this->owner)
             ->visit("/notes/{$this->note->id}/edit")
             ->type('', 'name')
             ->type('', 'text')
             ->press('Save')
             ->seePageIs("/notes/{$this->note->id}/edit")
             ->see('The name field is required')
             ->see('The text field is required');
    }

    /**
     * Note can't be edited by not an owner
     *
     * @return void
     */
    public function testNoteCantBeEditedByNotAnOwner()
    {
        $notAnOwner = factory(User::class)->create();
        $this->actingAs($notAnOwner)
             ->get("/notes/{$this->note->id}/edit")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);
    }

}
