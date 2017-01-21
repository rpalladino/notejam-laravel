<?php

namespace App\Http\Controllers\Pad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            ->route('all_notes')
            ->with('success', 'Pad is successfully updated');
    }
}
