<?php

namespace App\Http\Controllers\Pad;

use App\Http\Controllers\Controller;
use App\Pad;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewPad(Request $request, Pad $pad)
    {
        list($column, $direction) = $this->parseOrderParam($request);

        $notes = $pad->notes()
            ->orderBy($column, $direction)
            ->paginate(self::NOTES_PER_PAGE);

        return view('pads.view', compact('notes', 'pad'));
    }
}
