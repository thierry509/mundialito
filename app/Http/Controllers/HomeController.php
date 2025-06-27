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

            $inTheNews = News::with(['user', 'image'])
            ->whereHas('user', function ($query) {
                $query->where('roles', 'admin');
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->filter(function ($news) {
                return optional($news->image)->url || getYouTubeThumbnail($news->video_url);
            })
            ->take(3);

        return view('home', [
            'lastGame' => $lastGame,
            'nextGame' => $nextGame,
            'inTheNews' => $inTheNews,
        ]);
    }
}
