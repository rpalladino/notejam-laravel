<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class DeletePadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * The user who owns the pad.
     * @var User
     */
    private $owner;

    /**
     * The pad being deleted.
     * @var Pad
     */
    private $pad;

    public function setUp()
    {
        parent::setUp();
        $this->owner = factory(App\User::class)->create();
        $this->pad = factory(App\Pad::class)->create([
            'user_id' => $this->owner->id
        ]);
    }

    /**
     * Pad can be deleted by its owner
     *
     * @return void
     */
    public function testPadCanBeDeletedByItsOwner()
    {
        $this->actingAs($this->owner)
             ->visit("/pads/{$this->pad->id}/edit")
             ->click('Delete it')
             ->seePageIs("/pads/{$this->pad->id}/delete")
             ->see($this->pad->name)
             ->press("Yes, I want to delete this pad")
             ->see('Pad successfully deleted')
             ->notSeeInDatabase('pads', ['id' => $this->pad->id]);
    }

    /**
     * Pad can't be deleted by not an owner
     *
     * @return void
     */
    public function testPadCantBeDeletedByNotAnOwner()
    {
        $notOwner = factory(App\User::class)->create();

        // Forbidden to access confirmation
        $this->actingAs($notOwner)
             ->get("/pads/{$this->pad->id}/delete")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);

        // Forbidden to delete
        $this->post("/pads/{$this->pad->id}/delete")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);
    }
}
