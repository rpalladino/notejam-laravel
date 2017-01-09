<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * List all notes
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(App\User::class)->create();
        $notes = factory(App\Note::class, 10)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->visit('/');

        foreach($notes as $note) {
            $this->see($note->name);
        }
    }
}
