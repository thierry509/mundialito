<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminViewRequest;
use App\Http\Requests\HaveYearRequest;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KnockoutController extends Controller
{
    public function index(HaveYearRequest $request)
    {
        SEOMeta::setTitle('Schemat de l\'elimination du mundialito ');
        SEOMeta::setDescription('Schemat de l\'elimination du mundialito');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Schemat de l\'elimination du mundialito ');
        OpenGraph::setDescription('Schemat de l\'elimination du mundialito');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('Schemat de l\'elimination du mundialito ');
        TwitterCard::setDescription('Schemat de l\'elimination du mundialito');
        TwitterCard::setUrl(url()->current());

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
            'round' => Championship::where('year', $year)->get()->first()->knockout_round,
        ]);
    }

    public function adminIndex(AdminViewRequest $request)
    {
        $year = $request->query('year');
        $teamsNotInKnockout = Team::whereDoesntHave('matchesAsTeamA', function($query) use ($year) {
            $query->where('type', 'knockout')
                  ->whereHas('championship', function($q) use ($year) {
                      $q->where('year', $year);
                  });
        })
        ->whereDoesntHave('matchesAsTeamB', function($query) use ($year) {
            $query->where('type', 'knockout')
                  ->whereHas('championship', function($q) use ($year) {
                      $q->where('year', $year);
                  });
        })
        ->get();

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
            'teams' => $teamsNotInKnockout,
            'round' => Championship::where('year', $year)->get()->first()->knockout_round,
        ]);
    }
}
