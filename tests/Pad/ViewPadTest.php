<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class ViewPadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->owner = factory(App\User::class)->create();
        $this->pad = factory(App\Pad::class)->create([
            'user_id' => $this->owner->id
        ]);
    }

    /**
     * Pad can be viewed by its owner
     *
     * @return void
     */
    public function testPadCanBeViewedByItsOwner()
    {
        $notes = factory(App\Note::class, 10)->create([
            'pad_id'  => $this->pad->id,
            'user_id' => $this->owner->id
        ]);

        $this->actingAs($this->owner)
             ->visit('/')
             ->seeInElement('.pads', $this->pad->name)
             ->click($this->pad->name)
             ->seePageIs("/pads/{$this->pad->id}")
             ->seeTotalElements('.notes .name', 10);
    }

    /**
     * Pad can't be viewed by not an owner
     *
     * @return void
     */
    public function testPadCantBeViewedByNotAnOwner()
    {
        $notOwner = factory(App\User::class)->create();

        $this->actingAs($notOwner)
             ->get("/pads/{$this->pad->id}")
             ->assertResponseStatus(Response::HTTP_FORBIDDEN);
    }
}
