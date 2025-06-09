<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\EditorViewRequest;
use App\Http\Requests\EndGameRequest;
use App\Http\Requests\HaveYearRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UnpostponeGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Group;
use App\Models\Log;
use App\Services\GameService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(HaveYearRequest $request, GameService $gameService)
    {
        $year = $request->query('year');
        $games = $gameService->all($year);

        return view('games.index', [
            'games' => $games,
        ]);
    }

    public function adminIndex(EditorViewRequest $request, GameService $gameService)
    {
        $year = $request->query('year');

        $games = $gameService->all($year);

        return Inertia::render('Championship.Games', [
            'games' =>  $games,
            'groups' => Group::with('teams')->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->get(),
        ]);
    }

    public function store(StoreGameRequest $request, GameService $gameService)
    {
        $year = $request->query('year');
        $chamionship = Championship::where('year', $year)->first();
        $validated = $request->validated();

        $gameService->create($validated, $chamionship);

        return redirect()->back();
    }

    public function update(UpdateGameRequest $request, GameService $gameService)
    {
        DB::transaction(function () use ($request, $gameService) {

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
                'shootout_score_a' => $validated['shootoutScoreA'] ?? null,
                'shootout_score_b' => $validated['shootoutScoreB'] ?? null,
                'status' => $validated['isLive'] ? 'live' : 'finished',
            ]);

            Log::create([
                'action' => "update match d'identifiant " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);

            if ($game->type == 'knockout') {
                if ($game->status == 'finished') {
                    $nextGame = Game::with('championship')
                        ->whereHas('championship', function ($query) use ($game) {
                            $query->where('year', $game->championship->year);
                        })
                        ->where('position', getNextMatchPosition($game->position, $game->stage)['next_position'])
                        ->where('stage', getNextMatchPosition($game->position, $game->stage)['next_phase'])
                        ->first();
                    if (!$nextGame) {
                        $gameService->createKnockout([
                            ($game->position % 2 === 1 ? 'team1Id' : 'team2Id') => $gameService->determineWinner(
                                [$game->team_a_id, $game->team_a_goals, $game->shootout_score_a],
                                [$game->team_b_id, $game->team_b_goals, $game->shootout_score_b]
                            ),
                            'position' => getNextMatchPosition($game->position, $game->stage)['next_position'],
                            'location' => $game->location,
                            'stage' => nextStage($game->stage),
                            'type' => 'knockout',
                        ], $game->championship);
                    } else {
                        $nextGame->update([
                            ($game->position % 2 === 1 ? 'team_a_id' : 'team_b_id') => $gameService->determineWinner(
                                [$game->team_a_id, $game->team_a_goals, $game->shootout_score_a],
                                [$game->team_b_id, $game->team_b_goals, $game->shootout_score_b]
                            ),
                        ]);
                        // dd($game->position, $nextGame , [
                        //     ($game->position % 2 === 1 ? 'team_a_id' : 'team_b_id') => $gameService->determineWinner(
                        //         [$game->team_a_id, $game->team_a_goals, $game->shootout_score_a],
                        //         [$game->team_b_id, $game->team_b_goals, $game->shootout_score_b]
                        //     ),
                        // ]);
                    }
                }
            }
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
