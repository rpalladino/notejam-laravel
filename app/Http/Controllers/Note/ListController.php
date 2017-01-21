<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class ListController extends Controller
{
    const NOTES_PER_PAGE = 10;
    const DEFAULT_SORT_ORDER = "-updated";

    public function allNotes(Request $request) {
        list($column, $direction) = $this->parseSortOrder($request);

        $notes = $request
            ->user()
            ->notes()
            ->orderBy($column, $direction)
            ->paginate(self::NOTES_PER_PAGE);
        return view('notes.all_notes')->with('notes', $notes);
    }

    /**
     * Parse the sort order from request parameters, or use default
     *
     * @param Request
     *
     * @return array The column name in element 1, the direction in element 2
     */
    protected function parseSortOrder(Request $request)
    {
        $sortOrders = [
            "name" => ["name", "asc"],
            "-name" => ["name", "desc"],
            "updated" => ["updated_at", "asc"],
            "-updated" => ["updated_at", "desc"]
        ];

        return $sortOrders[$request->get('order', self::DEFAULT_SORT_ORDER)];
    }
}
