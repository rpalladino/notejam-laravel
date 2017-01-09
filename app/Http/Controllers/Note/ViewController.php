<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewNote(Request $request)
    {
        $note = Note::where(['id' => $request->id])->first();

        return view('notes.view')->with('note', $note);
    }
}
