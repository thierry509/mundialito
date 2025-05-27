<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminViewRequest;
use App\Http\Requests\HaveYearRequest;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KnockoutController extends Controller
{
    public function index(HaveYearRequest $request)
    {
        $year = $request->query('year');

        $round16 = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'round16')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');
        $quarter = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'quarter')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');

        $semi = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'semi')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');

        $final = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'final')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');

        return view('knockout.index', [
            'round16' => $round16,
            'quarter' => $quarter,
            'semi' => $semi,
            'final' => $final,
            'teams' => Team::all(),
            'round' => Championship::where('year', $year)->get()->first()->knockout_round,
        ]);
    }

    public function adminIndex(AdminViewRequest $request)
    {
        $year = $request->query('year');

        $round16 = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'round16')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');
        $quarter = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'quarter')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');

        $semi = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'semi')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');

        $final = Game::with(['teamA', 'teamB', 'championship'])
            ->where('stage', 'final')
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->orderBy('position')
            ->get()->keyBy('position');

        return Inertia::render('Championship.Knockout', [
            'round16' => $round16,
            'quarter' => $quarter,
            'semi' => $semi,
            'final' => $final,
            'teams' => Team::all(),
            'round' => Championship::where('year', $year)->get()->first()->knockout_round,
        ]);
    }
}
