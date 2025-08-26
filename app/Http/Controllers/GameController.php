<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteEventRequest;
use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\EditorViewRequest;
use App\Http\Requests\EndGameRequest;
use App\Http\Requests\HaveYearRequest;
use App\Http\Requests\ShootOnGoalRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UnpostponeGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Championship;
use App\Models\Event;
use App\Models\Game;
use App\Models\Group;
use App\Models\Log;
use App\Services\GameService;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
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

        SEOMeta::setTitle('Calendrier des Matchs - Mundialito Gonaïves' . $year);
        SEOMeta::setDescription('Consultez le programme complet des matchs du Mundialito aux Gonaïves. Dates, heures et lieux des rencontres.');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Calendrier des Matchs - Mundialito Gonaïves' . $year);
        OpenGraph::setDescription('Consultez le programme complet des matchs du Mundialito aux Gonaïves. Dates, heures et lieux des rencontres.');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('Calendrier des Matchs - Mundialito Gonaïves' . $year);
        TwitterCard::setDescription('Consultez le programme complet des matchs du Mundialito aux Gonaïves. Dates, heures et lieux des rencontres.');
        TwitterCard::setUrl(url()->current());

        $games = $gameService->all($year);

        return view('games.index', [
            'games' => $games,
        ]);
    }

    public function show(Request $request, $slug, $id)
    {

        SEOMeta::setTitle('Match ' . $id . ' - Mundialito Gonaïves ');
        SEOMeta::setDescription('Détails du match ' . $id . ' du Mundialito aux Gonaïves. Résultats, buteurs et statistiques.');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Match ' . $id . ' - Mundialito Gonaïves ');
        OpenGraph::setDescription('Détails du match ' . $id . ' du Mundialito aux Gonaïves. Résultats, buteurs et statistiques.');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('Match ' . $id . ' - Mundialito Gonaïves ');
        TwitterCard::setDescription('Détails du match ' . $id . ' du Mundialito aux Gonaïves. Résultats, buteurs et statistiques.');
        TwitterCard::setUrl(url()->current());
        $game = Game::findOrFail($id);
        $comments = $game->comments()->with('user', 'replies.user')->get();

        return view('games.show', [
            'game' => $game,
            'championship' => $game->championship,
            'comments' => $comments,
            'events' => $game->events()
                ->with('team')
                ->orderByDesc('minute')
                ->orderByDesc('added_time')
                ->get(),
        ]);
    }

    public function adminIndex(EditorViewRequest $request, GameService $gameService)
    {
        $year = $request->query('year');

        $games = $gameService->all($year);
        // dd($games);
        return Inertia::render('Championship.Games', [
            'games' =>  $games,
            'groups' => Group::with('teams')->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->get(),
        ]);
    }
    public function adminShow(EditorViewRequest $request, GameService $gameService, $id)
    {
        $game = $gameService->find($id);
        return Inertia::render('Championship.ShowGame', [
            'game' => $game,
            'championship' => $game->championship,
            'events' => $game->events()
                ->with('team')
                ->orderByDesc('minute')
                ->orderByDesc('added_time')
                ->get()
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
    public function shootOnGoal(ShootOnGoalRequest $request, GameService $gameService)
    {
        $validated = $request->validated();
        $game = Game::find($validated['game_id']);

        DB::transaction(function () use ($validated, $game, $gameService) {
            $team_a_goals = $game->team_a_goals ?? 0;
            $team_b_goals = $game->team_b_goals ?? 0;
            $game->update([
                'shootout_score_a' => $validated['shootout_score_a'],
                'shootout_score_b' => $validated['shootout_score_b'],
            ]);

            $this->nextGame($gameService, $game);
            $game->update([
                'status' => 'soon',
            ]);
            $game->save();

            Log::create([
                'action' => "créer un tir au but pour le match d'identifiant " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);
        });

        return redirect()->back();
    }
    public function storeEvent(StoreEventRequest $request, GameService $gameService)
    {
        $validated = $request->validated();
        $game = Game::find($validated['game_id']);

        $team = $validated['team'] === 'team_a' ? $game->teamA : $game->teamB;

        DB::transaction(function () use ($validated, $game, $team, $gameService) {
            $event = $game->events()->create([
                'type' => $validated['event_type'],
                'minute' => $validated['minute'],
                'added_time' => $validated['added_time'] ?? null,
                'player_name' => $validated['player_name'],
                'team_id' => $team->id,
            ]);

            if ($game->team_a_goals === null) {
                $game->team_a_goals = 0;
            }
            if ($game->team_b_goals === null) {
                $game->team_b_goals = 0;
            }

            if ($game->team_a_yellow_cards === null) {
                $game->team_a_yellow_cards = 0;
            }
            if ($game->team_b_yellow_cards === null) {
                $game->team_b_yellow_cards = 0;
            }
            if ($game->team_a_red_cards === null) {
                $game->team_a_red_cards = 0;
            }
            if ($game->team_b_red_cards === null) {
                $game->team_b_red_cards = 0;
            }


            $game->save();

            if ($event->type === 'goal') {
                if ($validated['team'] === 'team_a') {
                    $game->increment('team_a_goals');
                } else {
                    $game->increment('team_b_goals');
                }
                $game->save();
            }
            if ($event->type === 'carton_jaune') {
                if ($validated['team'] === 'team_a') {
                    $game->increment('team_a_yellow_cards');
                } else {
                    $game->increment('team_b_yellow_cards');
                }
                $game->save();
            }
            if ($event->type === 'carton_rouge') {
                if ($validated['team'] === 'team_a') {
                    $game->increment('team_a_red_cards');
                } else {
                    $game->increment('team_b_red_cards');
                }
                $game->save();
            }

            $game->update([
                'status' => 'soon',
            ]);

            Log::create([
                'action' => "créer un événement de match d'identifiant " . $event->id,
                'user_id' => Auth()->user()->id,
            ]);
        });

        return redirect()->back();
    }

    public function destroyEvent(DeleteEventRequest $request, $id)
    {
        $event = Event::findOrFail($id);

        $game = $event->game;

        DB::transaction(function () use ($event, $game) {
            if ($event->type === 'goal') {
                if ($event->team->id === $game->teamA->id) {
                    $game->decrement('team_a_goals');
                } else {
                    $game->decrement('team_b_goals');
                }
            }
            if ($event->type === 'carton_jaune') {
                if ($event->team->id === $game->teamA->id) {
                    $game->decrement('team_a_yellow_cards');
                } else {
                    $game->decrement('team_b_yellow_cards');
                }
            }
            if ($event->type === 'carton_rouge') {
                if ($event->team->id === $game->teamA->id) {
                    $game->decrement('team_a_red_cards');
                } else {
                    $game->decrement('team_b_red_cards');
                }
            }

            $event->delete();
            $game->update([
                'status' => 'soon',
            ]);
            Log::create([
                'action' => "supprimer un événement de match d'identifiant " . $event->id,
                'user_id' => Auth()->user()->id,
            ]);
        });

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

            $this->nextGame($gameService, $game);
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

    public function end(EndGameRequest $request, GameService $gameService)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'status' => 'finished',
        ]);
        $this->nextGame($gameService, $game);
        Log::create([
            'action' => "terminer le match d'identifiant " . $game->id,
            'user_id' => Auth()->user()->id,
        ]);
        // dd($game);
        // $this->nextGame($gameService, $game);
        return redirect()->back();
    }

    public function destroy(DeleteGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->delete();
        return redirect()->to(route('championship.game', ['year' => $game->championship->year]));
    }

    public function extaTime(EndGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'extra_time' => 'true',
        ]);
        Log::create([
            'action' => "ajouter extra time dans le match d'identifiant " . $game->id,
            'user_id' => Auth()->user()->id,
        ]);

        $game->update([
            'status' => 'soon',
        ]);

        // dd($game);
        // $this->nextGame($gameService, $game);
        return redirect()->back();
    }

    public function deleteExtratime(EndGameRequest $request)
    {
        $game = Game::find($request->validated()['id']);
        $game->update([
            'extra_time' => null,
        ]);
        Log::create([
            'action' => "delete prolonagation dans le match d'identifiant " . $game->id,
            'user_id' => Auth()->user()->id,
        ]);

        $game->update([
            'status' => 'soon',
        ]);
        return redirect()->back();
    }

    public function deleteShootOnGoal(EndGameRequest $request, GameService $gameService)
    {
        $game = Game::find($request->validated()['id']);
        DB::transaction(function () use ($game, $gameService) {
            $game->update([
                'shootout_score_a' => null,
                'shootout_score_b' => null,
            ]);


            $this->nextGame($gameService, $game);
            $game->update([
                'status' => 'soon',
            ]);
            $game->save();

            Log::create([
                'action' => "Suprimmer Tir au but " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);
        });
    }

    public function clearScore($id)
    {
        $game = Game::findOrFail($id);

        DB::transaction(function () use ($game) {
            // Remettre les scores et stats à zéro
            $game->update([
                'team_a_goals' => null,
                'team_b_goals' => null,
                'team_a_yellow_cards' => null,
                'team_b_yellow_cards' => null,
                'team_a_red_cards' => null,
                'team_b_red_cards' => null,
                'team_a_scorers' => null,
                'team_b_scorers' => null,
                'shootout_score_a' => null,
                'shootout_score_b' => null,
                'extra_time' => null,
                'status' => 'soon',
            ]);

            // Supprimer les événements liés (buts, cartons, etc.)
            $game->events()->delete();

            // Journalisation
            Log::create([
                'action' => "Réinitialiser les scores et événements du match d'identifiant " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);
        });

        return redirect()->back();
    }

    public function nextGame(GameService $gameService, Game $game)
    {

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
    }
}
