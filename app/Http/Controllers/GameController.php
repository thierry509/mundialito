<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

class GameController extends Controller
{
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

        Game::create([
            'championship_id' => $chamionship->id,
            "team_a_id" => $validated['team1Id'],
            "team_b_id" => $validated['team2Id'],
            "date_time" => Carbon::createFromFormat(
                'Y-m-d H:i',
                $validated['date'] . ' ' . $validated['time']
            )->format('Y-m-d H:i:s'),
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

    public function destroy(DeleteGameRequest $request){
        $game = Game::find($request->validated()['id']);
        $game->delete();

        redirect()->back();
    }
}
