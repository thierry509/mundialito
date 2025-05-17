<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KnockoutController extends Controller
{
    public function index()
    {
        return view('knockout.index');
    }

    public function adminIndex(Request $request)
    {
        $year = $request->query('year');
        $games = Game::with(['teamA', 'teamB', 'championship'])
            ->where('type', 'knockout')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->orderBy('position')
            ->get()
            ->groupBy('stage');
        return Inertia::render('Championship.Knockout', [
            'games' => $games,
            'teams' => Team::all(),
        ]);
    }
}
