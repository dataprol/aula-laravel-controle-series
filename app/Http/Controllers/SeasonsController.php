<?php

namespace App\Http\Controllers;

use App\Models\Series;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        /* $seasons = Season::query()
            ->with("episodes")
            ->where("series_id", $series)
            ->get(); */
        $seasons = $series->seasons()->with('episodes')->get();
        return view("seasons.index")->withSeasons($seasons)->withSeries($series);
    }
}
