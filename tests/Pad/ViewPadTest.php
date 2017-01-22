<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewPadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Pad can be viewed by its owner
     *
     * @return void
     */
    public function testPadCanBeViewedByItsOwner()
    {
        $owner = factory(App\User::class)->create();
        $pad = factory(App\Pad::class)->create([
            'user_id' => $owner->id
        ]);
        $notes = factory(App\Note::class, 10)->create([
            'pad_id'  => $pad->id,
            'user_id' => $owner->id
        ]);

        $this->actingAs($owner)
             ->visit('/')
             ->seeInElement('.pads', $pad->name)
             ->click($pad->name)
             ->seePageIs("/pads/{$pad->id}");
    }
}
