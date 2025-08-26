<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Game;
use Illuminate\Support\Facades\Response;
use App\Models\News;
use App\Services\GameService;

class SitemapController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        $years = \App\Models\Championship::all('year');

        $games = collect();

        foreach ($years as $year) {
            $games = $games->merge($this->allGames($year->year));
        }

        $xml = view('sitemap', compact('news', 'years', 'games'))->render();

        return Response::make($xml, 200)->header('Content-Type', 'application/xml');
    }


    public function allGames($year)
    {
        return Game::with(['teamA', 'teamB', 'championship'])
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->whereNotNull('team_a_id')
            ->whereNotNull('team_b_id')
            ->orderBy('date_time')
            ->get();
    }
}
