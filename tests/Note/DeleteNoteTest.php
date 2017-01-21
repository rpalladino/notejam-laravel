<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class DeleteNoteTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * The user who owns the note.
     * @var User
     */
    private $owner;

    /**
     * The note being deleted.
     * @var Note
     */
    private $note;

    public function setUp()
    {
        parent::setUp();
        $this->owner = factory(App\User::class)->create();
        $this->note = factory(App\Note::class)->create([
            'user_id' => $this->owner->id
        ]);
    }

    /**
     * Note can be deleted by its owner
     *
     * @return void
     */
    public function testNoteCanBeDeletedByItsOwner()
    {
        $this->actingAs($this->owner)
             ->visit("/notes/{$this->note->id}")
             ->click('Delete it')
             ->seePageIs("/notes/{$this->note->id}/delete")
             ->see($this->note->title)
             ->press("Yes, I want to delete this note")
             ->see('Note successfully deleted')
             ->notSeeInDatabase('notes', ['id' => $this->note->id]);
    }

    /**
     * Note can't be deleted by not an owner
     *
     * @return void
     */
    public function testNoteCantBeDeletedByNotAnOwner()
    {
        $notOwner = factory(App\User::class)->create();

        // Forbidden to access confirmation
        $this->actingAs($notOwner)
             ->get("/notes/{$this->note->id}/delete")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);

        // Forbidden to delete
        $this->post("/notes/{$this->note->id}/delete")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);
    }
}
