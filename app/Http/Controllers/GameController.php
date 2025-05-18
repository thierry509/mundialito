<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\EndGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UnpostponeGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->query('year');
        $games = Game::with(['teamA', 'teamB', 'championship'])
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', 2024);
            })
            ->orderBy('stage')
            ->get()
            ->groupBy('stage');

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
            ->orderBy('stage')
            ->get()
            ->groupBy('stage');

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

        // dd($validated);
        Game::create([
            'championship_id' => $chamionship->id,
            "team_a_id" => $validated['team1Id'],
            "team_b_id" => $validated['team2Id'],
            "date_time" => $dateTime,
            "position" => $validated['position'] ?? null,
            'stage' => $validated['stage'],
            'location' => $validated['location'],
            'type' => $validated['type'],
        ]);

        return redirect()->back();
    }

    public function update(UpdateGameRequest $request)
    {
        $validated = $request->validated();
        $game = Game::find($validated['gameId']);
        $game->update([
            'team_a_goals' => $validated['teamAGoal'],
            'team_b_goals' => $validated['teamBGoal'],
        ]);
        redirect()->back();
    }

    public function postpone(DeleteGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'status' => 'postponed',
        ]);
        redirect() . back();
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
        redirect()->back();
    }

    function end(EndGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'status' => 'finished',
        ]);
        redirect()->back();
    }

    public function destroy(DeleteGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->delete();
        redirect()->back();
    }
}
