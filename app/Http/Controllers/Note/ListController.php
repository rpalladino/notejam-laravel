<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function listNotes(Request $request)
    {
        list($column, $direction) = $this->parseOrderParam($request);

        $notes = $request
            ->user()
            ->notes()
            ->with('pad')
            ->orderBy($column, $direction)
            ->paginate(self::NOTES_PER_PAGE);

        return view('notes.list')->with('notes', $notes);
    }
}
