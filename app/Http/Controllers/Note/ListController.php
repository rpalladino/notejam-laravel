<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class ListController extends Controller
{
    const NOTES_PER_PAGE = 10;

    public function allNotes(Request $request) {
        $notes = $request->user()->notes()->paginate(self::NOTES_PER_PAGE);
        return view('notes.all_notes')->with('notes', $notes);
    }
}
