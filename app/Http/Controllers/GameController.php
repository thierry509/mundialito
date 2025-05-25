<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\EndGameRequest;
use App\Http\Requests\HaveYearRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UnpostponeGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Group;
use App\Models\Log;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(HaveYearRequest $request)
    {
        $year = $request->query('year');
        $games = Game::with(['teamA', 'teamB', 'championship'])
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->orderBy('date_time') // Ordre principal par date/heure
            ->get()
            ->groupBy('stage') // Groupement après le tri
            ->map(function ($group) {
                // Optionnel: re-trier chaque groupe si nécessaire
                return $group->sortBy('date_time');
            });

        return view('games.index', [
            'games' => $games,
        ]);
    }

    public function adminIndex(Request $request)
    {
        $year = $request->query('year');

        $games = Game::with(['teamA', 'teamB', 'championship'])
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->orderBy('date_time') // Ordre principal par date/heure
            ->get()
            ->groupBy('stage') // Groupement après le tri
            ->map(function ($group) {
                // Optionnel: re-trier chaque groupe si nécessaire
                return $group->sortBy('date_time');
            });

        // dd($games[1][1]);

        return Inertia::render('Championship.Games', [
            'games' =>  $games,
            'groups' => Group::with('teams')->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->get(),
        ]);
    }

    public function store(StoreGameRequest $request)
    {
        $year = $request->query('year');
        $chamionship = Championship::where('year', $year)->first();
        $validated = $request->validated();

        $dateTime = (isset($validated['date']) && isset($validated['time'])) ? Carbon::createFromFormat(
            'Y-m-d H:i',
            $validated['date'] . ' ' . $validated['time']
        )->format('Y-m-d H:i:s') : null;

        // dd($dateTime);
        DB::transaction(function () use ($validated, $dateTime, $chamionship) {
            $game = Game::create([
                'championship_id' => $chamionship->id,
                "team_a_id" => $validated['team1Id'],
                "team_b_id" => $validated['team2Id'],
                "date_time" => $dateTime,
                "position" => $validated['position'] ?? null,
                'stage' => $validated['stage'],
                'location' => $validated['location'],
                'type' => $validated['type'],
            ]);

            Log::create([
                'action' => "creer creer match d'identifiant " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);
        });

        return redirect()->back();
    }

    public function update(UpdateGameRequest $request)
    {
        DB::transaction(function () use ($request) {

            $validated = $request->validated();
            $game = Game::find($validated['gameId']);
            $game->update([
                'team_a_goals' => $validated['teamAGoals'],
                'team_b_goals' => $validated['teamBGoals'],
                'team_a_yellow_cards' => $validated['teamAYellowCards'],
                'team_b_yellow_cards' => $validated['teamBYellowCards'],
                'team_a_red_cards' => $validated['teamARedCards'],
                'team_b_red_cards' => $validated['teamBRedCards'],
                'team_a_scorers' => $validated['teamAScorers'] ?? null,
                'team_b_scorers' => $validated['teamBScorers'] ?? null,
                'status' => $validated['isLive']? 'live' : 'finished    ',
            ]);

            Log::create([
                'action' => "update match d'identifiant " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);
        });
        return redirect()->back();
    }

    public function postpone(DeleteGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'status' => 'postponed',
        ]);
        Log::create([
            'action' => "creer creer match d'identifiant " . $game->id,
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back();
    }

    public function live(DeleteGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'status' => 'live',
        ]);
        return redirect()->back();
    }

    public function unpostpone(UnpostponeGameRequest $request)
    {
        $validated = $request->validated();
        $game = Game::find($validated['id']);
        $game->update([
            'status' => 'soon',
            "date_time" => Carbon::createFromFormat(
                'Y-m-d H:i',
                $validated['date'] . ' ' . $validated['time']
            )->format('Y-m-d H:i:s'),
            'location' => $validated['location'],
        ]);
        return redirect()->back();
    }

    function end(EndGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'status' => 'finished',
        ]);
        return redirect()->back();
    }

    public function destroy(DeleteGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->delete();
        return redirect()->back();
    }

}
