<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The number of notes to display per page.
     * @var integer
     */
    const NOTES_PER_PAGE = 10;

    /**
     * The default notes sort order.
     * @var string
     */
    const DEFAULT_SORT_ORDER = "-updated";

    /**
     * Parse the sort order from request parameter, or use default
     *
     * @param Request
     *
     * @return array The column name in element 1, the direction in element 2
     */
    protected function parseOrderParam(Request $request)
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
