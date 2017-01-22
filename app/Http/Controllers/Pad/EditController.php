<?php

namespace App\Http\Controllers\Pad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pad\PadRequest as Request;
use App\Pad;

class EditController extends Controller
{
    public function showEditPadForm(Pad $pad)
    {
        return view('pads.edit')->with('pad', $pad);
    }

    public function updatePad(Request $request, Pad $pad)
    {
        $pad->name = $request->name;
        $pad->save();

        return redirect()
            ->route('list-notes')
            ->with('success', 'Pad is successfully updated');
    }
}
