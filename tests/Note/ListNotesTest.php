<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Note;
use App\User;

class ListNotesTest extends TestCase
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

    /**
     * Notes can be sorted by name
     *
     * @return void
     */
    public function testNotesCanBeSortedByName()
    {
        $attrs = ['user_id' => $this->user->id];
        $notes = [
            factory(Note::class)->create($attrs + ['name' => 'Date']),
            factory(Note::class)->create($attrs + ['name' => 'Fig']),
            factory(Note::class)->create($attrs + ['name' => 'Apple']),
        ];

        // ascending
        $this->actingAs($this->user)
             ->visit('/?order=name')
             ->seeInElement('table.notes tr:nth-child(2) .name', 'Apple')
             ->seeInElement('table.notes tr:nth-child(3) .name', 'Date')
             ->seeInElement('table.notes tr:nth-child(4) .name', 'Fig');

        // descending
        $this->visit('/?order=-name')
             ->seeInElement('table.notes tr:nth-child(2) .name', 'Fig')
             ->seeInElement('table.notes tr:nth-child(3) .name', 'Date')
             ->seeInElement('table.notes tr:nth-child(4) .name', 'Apple');
    }

    /**
     * Notes can be sorted by name
     *
     * @return void
     */
    public function testNotesCanBeSortedByModifiedDate()
    {
        $attrs = ['user_id' => $this->user->id];
        $notes = [
            factory(Note::class)->create($attrs + [
                'name' => 'Third', 'updated_at' => '2017-01-31 12:00:00'
            ]),
            factory(Note::class)->create($attrs + [
                'name' => 'First', 'updated_at' => '2017-01-01 12:00:00'
            ]),
            factory(Note::class)->create($attrs + [
                'name' => 'Second', 'updated_at' => '2017-01-15 12:00:00'
            ]),
        ];

        // ascending
        $this->actingAs($this->user)
             ->visit('/?order=updated')
             ->seeInElement('table.notes tr:nth-child(2) .name', 'First')
             ->seeInElement('table.notes tr:nth-child(3) .name', 'Second')
             ->seeInElement('table.notes tr:nth-child(4) .name', 'Third');

        // descending
        $this->visit('/?order=-updated')
             ->seeInElement('table.notes tr:nth-child(2) .name', 'Third')
             ->seeInElement('table.notes tr:nth-child(3) .name', 'Second')
             ->seeInElement('table.notes tr:nth-child(4) .name', 'First');
    }
}
