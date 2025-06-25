<?php

namespace App\Services;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Log;

class GameService
{
    public function all($year){
        $games = Game::with(['teamA', 'teamB', 'championship'])
        ->whereHas('championship', function ($query) use ($year) {
            $query->where('year', $year);
        })
        ->whereNotNull('team_a_id') // Exclut les matchs où teamA est null
        ->whereNotNull('team_b_id') // Exclut les matchs où teamB est null
        ->orderBy('date_time')
        ->get()
        ->groupBy('stage')
        ->map(function ($group) {
            return $group->sortBy('date_time');
        });
    
    return $games;
    }
    public function create(array $data, $chamionship)
    {
        $dateTime = (isset($data['date']) && isset($data['time'])) ? Carbon::createFromFormat(
            'Y-m-d H:i',
            $data['date'] . ' ' . $data['time']
        )->format('Y-m-d H:i:s') : null;

        DB::transaction(function () use ($data, $dateTime, $chamionship) {
            $game = Game::create([
                'championship_id' => $chamionship->id,
                "team_a_id" => $data['team1Id']?? null,
                "team_b_id" => $data['team2Id'] ?? null,
                "date_time" => $dateTime,
                "position" => $data['position'] ?? null,
                'stage' => $data['stage'],
                'location' => $data['location'],
                'type' => $data['type'],
            ]);

            Log::create([
                'action' => "creer creer match d'identifiant " . $game->id,
                'user_id' => Auth()->user()->id,
            ]);
        });
    }

    public function createKnockout($data, $championship)
    {
        $this->create(array_merge($data,), $championship);
    }

    public function determineWinner(array $team1, array $team2)
    {
        // dd($team1[1], $team2[1]);
        if ($team1[1] > $team2[1]) { // goals are at index 2
            return $team1[0]; // team1Id is at index 0
        } elseif ($team2[1] > $team1[1]) {
            return $team2[0]; // team2Id is at index 0
        } elseif (isset($team1[2]) && isset($team2[2])) { // penalty is at index 3
            if ($team1[2] > $team2[2]) {
            return $team1[0];
            } elseif ($team2[2] > $team1[2]) {
            return $team2[0];
            }
        }
        return null; // Match is a draw if no winner can be determined
    }
}
