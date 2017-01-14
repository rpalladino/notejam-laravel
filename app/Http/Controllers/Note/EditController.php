<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\EditRequest;
use App\Note;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function showEditNoteForm(Request $request)
    {
        $note = Note::find($request->id);

        return view('notes.edit')->with('note', $note);
    }

    public function updateNote(EditRequest $request)
    {
        $note = Note::find($request->id);
        $note->name = $request->name;
        $note->text = $request->text;
        $note->save();

        return redirect()
            ->route('note', ['id' => $note->id])
            ->with('success', 'Note is successfully updated');
    }
}
