<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Note;
use App\User;

class ListTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * All notes owned by user can be listed
     *
     * @return void
     */
    public function testAllNotesOwnedByUserCanBeListed()
    {
        $notesOwnedByUser = factory(Note::class, 10)->create([
            'user_id' => $this->user->id
        ]);

        $this->actingAs($this->user)->visit('/');

        foreach($notesOwnedByUser as $note) {
            $this->see($note->name);
        }
    }

    /**
     * Notes not owned by user can't be listed
     *
     * @return void
     */
    public function testNotesNotOwnedByUserCantBeListed()
    {
        $notUser = factory(User::class)->create();

        $notesNotOwnedByUser = factory(Note::class, 10)->create([
            'user_id' => $notUser->id
        ]);

        $this->actingAs($this->user)->visit('/');

        foreach($notesNotOwnedByUser as $note) {
            $this->dontSee($note->name);
        }
    }
}
