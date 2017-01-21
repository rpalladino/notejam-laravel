<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Show delete confirmation page
     *
     * @param App\Note $note The note to delete
     */
    public function showConfirmation(Note $note)
    {
        return view('notes.delete')->with('note', $note);
    }

    /**
     * Delete a note
     *
     * @param App\Note $note The note to delete
     */
    public function deleteNote(Note $note)
    {
        $note->delete();

        return redirect()
            ->route('all_notes')
            ->with('success', 'Note successfully deleted');
    }
}
