<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Note can be deleted by its owner
     *
     * @return void
     */
    public function testNoteCanBeDeletedByItsOwner()
    {
        $owner = factory(App\User::class)->create();
        $note = factory(App\Note::class)->create([
            'user_id' => $owner->id
        ]);

        $this->actingAs($owner)
             ->visit("/notes/{$note->id}")
             ->click('Delete it')
             ->seePageIs("/notes/{$note->id}/delete")
             ->see($note->title)
             ->press("Yes, I want to delete this note")
             ->see('Note successfully deleted')
             ->notSeeInDatabase('notes', ['id' => $note->id]);
    }
}
