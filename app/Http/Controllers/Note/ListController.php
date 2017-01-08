<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function allNotes() {
        $notes = Note::all();
        return view('notes.all_notes')->with('notes', $notes);
    }
}
