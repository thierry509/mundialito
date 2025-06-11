<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lastGame = Game::with(['teamA', 'teamB', 'championship'])
            ->where('status', 'finished')
            ->orderBy('date_time', 'desc')
            ->first();

        $nextGame = Game::with(['teamA', 'teamB', 'championship'])
            ->where('status', 'soon')
            ->where('date_time', '>', now())
            ->orderBy('date_time', 'asc')
            ->first();

        $inTheNews = News::with('User')
            ->whereHas('User', function ($query) {
                $query->where('roles', 'admin');
            })
            ->whereHas('Image', function ($query) {
                $query->whereNotNull('url');
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('home', [
            'lastGame' => $lastGame,
            'nextGame' => $nextGame,
            'inTheNews' => $inTheNews,
        ]);
    }
}
