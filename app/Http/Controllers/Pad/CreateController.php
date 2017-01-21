<?php

namespace App\Http\Controllers\Pad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pad;

class CreateController extends Controller
{
    public function showCreatePadForm()
    {
        return view('pads.create');
    }

    public function createPad(Request $request)
    {
        $pad = new Pad();
        $pad->name = $request->name;
        $pad->user()->associate($request->user());
        $pad->save();

        return redirect()
            ->route('all_notes')
            ->with('success', 'Pad successfully created');
    }
}
