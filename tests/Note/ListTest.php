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
     * Notes owned by user can be listed
     *
     * @return void
     */
    public function testNotesOwnedByUserCanBeListed()
    {
        $notesOwnedByUser = factory(Note::class, 3)->create([
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

        $notesNotOwnedByUser = factory(Note::class, 3)->create([
            'user_id' => $notUser->id
        ]);

        $this->actingAs($this->user)->visit('/');

        foreach($notesNotOwnedByUser as $note) {
            $this->dontSee($note->name);
        }
    }

    /**
     * Notes are listed ten per page
     *
     * @return void
     */
    public function testNotesAreListedTenPerPage()
    {
        $notes = factory(Note::class, 25)->create([
            'user_id' => $this->user->id
        ]);

        // View first 10 notes on page 1
        $this->actingAs($this->user)
             ->visit('/')
             ->seeTotalElements('.notes .name', 10);

        // View next 10 notes on page 2
        $this->click('2')
             ->seeTotalElements('.notes .name', 10);

        // View last 5 notes on page 3
        $this->click('3')
             ->seeTotalElements('.notes .name', 5);
    }
}
