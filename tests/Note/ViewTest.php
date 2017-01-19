<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use App\Note;
use App\User;

class ViewTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * The note being viewed.
     * @var Note
     */
    private $note;

    /**
     * The user who owns the note.
     * @var User
     */
    private $owner;

    public function setUp()
    {
        parent::setUp();
        $this->owner = factory(User::class)->create();
        $this->note = factory(Note::class)->create([
            'user_id' => $this->owner->id
        ]);
    }

    /**
     * Note can successfully be viewed
     *
     * @return void
     */
    public function testNoteCanBeViewedByItsOwner()
    {
        $this->actingAs($this->owner)
             // Click note name from list
             ->visit('/')
             ->click($this->note->name)
            // Should transition to view note route
             ->seePageIs("/notes/{$this->note->id}")
             // Should see note name and text
             ->see($this->note->name)
             ->see($this->note->text);
    }

    /**
     * Note can't be viewed by not an owner
     *
     * @return void
     */
    public function testNoteCantBeViewedByNotAnOwner()
    {
        $notAnOwner = factory(User::class)->create();
        $this->actingAs($notAnOwner)
             ->get("/notes/{$this->note->id}")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);
    }
}
