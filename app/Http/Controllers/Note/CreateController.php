<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\NoteRequest as Request;
use App\Note;

class CreateController extends Controller
{
    public function showCreateNoteForm()
    {
        return view('notes.create')->with('note', new Note());
    }

    public function createNote(Request $request)
    {
        $note = new Note();
        $note->name = $request->name;
        $note->text = $request->text;
        $note->user()->associate($request->user());
        $note->pad()->associate($request->pad);
        $note->save();

        return redirect()
            ->route('list-notes')
            ->with('success', 'Note successfully created');
    }
}
