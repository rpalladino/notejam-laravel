<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Note can be successfully created
     *
     * @return void
     */
    public function testNoteCanBeSuccessfullyCreated()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/notes/create')
             ->type('Things to do', 'name')
             ->type('Buy milk', 'text')
             ->press('Save')
             ->seeRouteIs('all_notes')
             ->see('Note successfully created')
             ->seeInDatabase('notes', [
                 'name' => 'Things to do',
                 'text' => 'Buy milk'
             ]);
    }

    /**
     * Note can't be created by anonymous user
     *
     * @return void
     */
    public function testNoteCantBeCreatedByAnonymousUser()
    {
        $this->visit('/notes/create')
             ->seeRouteIs('signin');
    }
}
