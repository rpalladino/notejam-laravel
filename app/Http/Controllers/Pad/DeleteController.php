<?php

namespace App\Http\Controllers\Pad;

use App\Http\Controllers\Controller;
use App\Pad;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Show delete confirmation page
     *
     * @param App\Pad $pad The pad to delete
     */
    public function showConfirmation(Pad $pad)
    {
        return view('pads.delete')->with('pad', $pad);
    }

    /**
     * Delete a pad
     *
     * @param App\Pad $pad The pad to delete
     */
    public function deletePad(Pad $pad)
    {
        $pad->delete();

        return redirect()
            ->route('list-notes')
            ->with('success', 'Pad successfully deleted');
    }
}
