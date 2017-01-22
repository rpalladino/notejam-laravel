<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\EditRequest;
use App\Note;

class EditController extends Controller
{
    public function showEditNoteForm(Note $note)
    {
        return view('notes.edit')->with('note', $note);
    }

    public function updateNote(Note $note, EditRequest $request)
    {
        $note->name = $request->name;
        $note->text = $request->text;
        $note->pad()->associate($request->pad);
        $note->save();

        return redirect()
            ->route('note', ['id' => $note->id])
            ->with('success', 'Note is successfully updated');
    }
}
