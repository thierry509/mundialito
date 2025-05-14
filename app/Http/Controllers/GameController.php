<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
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


        $games = Game::with(['teamA.group', 'teamB.group', 'championship'])
            ->whereHas('championship', fn($q) => $q->where('year', $year))
            ->get();

        $grouped = ['groups' => []];

        foreach ($games as $game) {
            $groupName = $game->teamA()->first()->group()->first()->name ?? $game->teamB()->first()->group()->first();

            if (!isset($grouped['groups'][$groupName])) {
                $grouped['groups'][$groupName] = [];
            }

            $grouped['groups'][$groupName][] = [
                'id' => $game->id,
                'teamA' => $game->teamA->name,
                'teamB' => $game->teamB->name,
                'date' => $game->date_time,
            ];
        }
        return Inertia::render('Championship.Games', [
            'games' => $grouped,

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
            'location' => $validated['location'],
            'type' => $validated['type'],
        ]);

        return redirect()->back();
    }
}
