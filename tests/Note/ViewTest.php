<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Note can successfully be viewed
     *
     * @return void
     */
    public function testNoteCanBeSuccessfullyViewed()
    {
        $user = factory(App\User::class)->create();
        $note = factory(App\Note::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
             // Click note name from list
             ->visit('/')
             ->click($note->name)
            // Should transition to view note route
             ->seePageIs("/notes/{$note->id}")
             // Should see note name and text
             ->see($note->name)
             ->see($note->text);
    }
}
