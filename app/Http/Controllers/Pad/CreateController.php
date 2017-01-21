<?php

namespace App\Http\Controllers\Pad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pad\CreatePadRequest as Request;
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
