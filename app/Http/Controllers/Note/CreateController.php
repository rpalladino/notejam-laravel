<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\CreateRequest;
use App\Note;

class CreateController extends Controller
{
    public function showCreateNoteForm()
    {
        return view('notes.create')->with('note', new Note());
    }

    public function createNote(CreateRequest $request)
    {
        $note = new Note();
        $note->name = $request->name;
        $note->text = $request->text;
        $note->user()->associate($request->user());
        $note->save();

        return redirect()
            ->route('list-notes')
            ->with('success', 'Note successfully created');
    }
}
