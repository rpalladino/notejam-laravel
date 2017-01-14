<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;

class ViewController extends Controller
{
    public function viewNote(Note $note)
    {
        return view('notes.view')->with('note', $note);
    }
}
