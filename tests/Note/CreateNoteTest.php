<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pad;

class CreateNoteTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->owner =factory(App\User::class)->create();
    }

    /**
     * Note can be successfully created
     *
     * @return void
     */
    public function testNoteCanBeSuccessfullyCreated()
    {
        $this->actingAs($this->owner)
             ->visit('/notes/create')
             ->type('Things to do', 'name')
             ->type('Buy milk', 'text')
             ->press('Save')
             ->seeRouteIs('list-notes')
             ->see('Note successfully created')
             ->seeInDatabase('notes', [
                 'name' => 'Things to do',
                 'text' => 'Buy milk'
             ]);
    }

    /**
     * Note can be added to a pad
     *
     * @return void
     */
    public function testNoteCanBeAddedToAPad()
    {
        $pad = factory(App\Pad::class)->create([
            'name' => 'Recipes',
            'user_id' => $this->owner->id
        ]);

        $this->actingAs($this->owner)
             ->visit('/notes/create')
             ->type("My Mom's Banana Bread", 'name')
             ->type("Just ask her to make it!", 'text')
             ->select($pad->id, 'pad')
             ->press('Save')
             ->seeInDatabase('notes', [
                 'name' => "My Mom's Banana Bread",
                 'pad_id' => $pad->id
             ]);
    }

    /**
     * Note can't be added to another user's pad
     *
     * @return void
     */
    public function testNoteCantBeAddedToAnotherUsersPad()
    {
        $anotherUser = factory(App\User::class)->create();
        $pad = factory(App\Pad::class)->create([
            'user_id' => $anotherUser->id
        ]);

        $this->actingAs($this->owner)
             ->post('/notes/create', [
                 'name' => "Directions to wedding",
                 'text' => "Take 85 to Saratoga",
                 'pad' => $pad->id
             ])
             ->assertResponseStatus(403);
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

    /**
     * Note can't be created if required fields are missing
     *
     * @return void
     */
    public function testNoteCantBeCreatedIfRequiredFieldsAreMissing()
    {
        $this->actingAs($this->owner)
             ->visit('/notes/create')
             ->press('Save')
             ->seeRouteIs('create-note')
             ->see('The name field is required')
             ->see('The text field is required');
    }
}
