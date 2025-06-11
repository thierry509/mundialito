<?php

namespace App\Services;

use App\Models\Championship;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Support\Collection;

class RankingService
{
    public function getGroupRankings($year): Collection
    {
        return Group::with(['teams' => function ($query) use ($year) {
            $query->with(['viewRanking' => function ($q) use ($year) {
                $q->where('year', $year);
            }]);
        }])
            ->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->get()
            ->map(function ($group) use ($year) {
                $group->teams->each(function ($team) {
                    if ($team->viewRanking && $team->viewRanking->isNotEmpty()) {
                        $ranking = $team->viewRanking->first();
                        if ($ranking) {
                            foreach ($ranking->toArray() as $key => $value) {
                                if (!in_array($key, ['team_id', 'id'])) {
                                    $team->$key = $value;
                                }
                            }
                        }
                        unset($team->viewRanking);
                    }
                });

                $group->teams = $this->sortTeams($group->teams, $year);
                return $group;
            });
    }

    /**
     * Trie un tableau d'équipes selon des règles de classement footballistiques
     *
     * @param Collection $teams Collection d'équipes à trier
     * @param array|null $rules Règles de tri personnalisées (par défaut: FIFA standard)
     * @return Collection Collection triée
     */
    public function sortTeams(Collection $teams, $year, ?array $rules = null): Collection
    {
        $rankingRules = Championship::where('year', $year)->with('rankingRules')->first()->rankingRules->pluck('order', 'code');
        $rules = $rules ?? $rankingRules;

        // 1. Préparation des confrontations directes
        $teamIds = $teams->pluck('id')->toArray();
        $directMatches = $this->getDirectMatches($teamIds, $year); // Nouvelle méthode à implémenter

        $teamArray = $teams->all();

        usort($teamArray, function ($a, $b) use ($rules, $directMatches) {
            // 2. Comparaison standard selon les règles
            foreach ($rules as $field => $order) {
                // 3. Gestion spéciale de la confrontation directe
                if ($field === 'directConfrontation') {
                    // On ne compare que si égalité sur les critères précédents
                    continue;
                }

                $valueA = $a->$field ?? 0;
                $valueB = $b->$field ?? 0;

                if (is_numeric($valueA)) $valueA = (float) $valueA;
                if (is_numeric($valueB)) $valueB = (float) $valueB;

                if ($valueA != $valueB) {
                    return $order === 'desc'
                        ? ($valueA > $valueB ? -1 : 1)
                        : ($valueA < $valueB ? -1 : 1);
                }
            }

            // 4. Application de la confrontation directe si égalité
            $confrontation = $this->compareDirectConfrontation($a->id, $b->id, $directMatches);
            if ($confrontation !== 0) {
                return $confrontation;
            }

            return 0;
        });

        return collect($teamArray)->values();
    }
    private function getDirectMatches(array $teamIds, int $year): array
    {
        return Game::whereIn('team_a_id', $teamIds)
            ->whereIn('team_b_id', $teamIds)
            ->whereYear('created_at', $year)
            ->get()
            ->groupBy(function ($match) {
                return $match->team_a_id < $match->team_b_id
                    ? "{$match->team_a_id}-{$match->team_b_id}"
                    : "{$match->team_b_id}-{$match->team_a_id}";
            })
            ->toArray();
    }
    private function compareDirectConfrontation(int $teamAId, int $teamBId, array $directMatches): int
    {
        $key = $teamAId < $teamBId ? "{$teamAId}-{$teamBId}" : "{$teamBId}-{$teamAId}";

        if (!isset($directMatches[$key])) {
            return 0; // Pas de match direct
        }

        $matches = $directMatches[$key];
        $teamAPoints = 0;
        $teamBPoints = 0;

        foreach ($matches as $match) {
            if ($match['team_a_id'] == $teamAId) {
                $teamAPoints += $match['team_a_goals'] > $match['team_b_goals'] ? 3 : ($match['team_a_goals'] == $match['team_b_goals'] ? 1 : 0);
                $teamBPoints += $match['team_b_goals'] > $match['team_a_goals'] ? 3 : ($match['team_b_goals'] == $match['team_a_goals'] ? 1 : 0);
            } else {
                $teamAPoints += $match['team_b_goals'] > $match['team_a_goals'] ? 3 : ($match['team_b_goals'] == $match['team_a_goals'] ? 1 : 0);
                $teamBPoints += $match['team_a_goals'] > $match['team_b_goals'] ? 3 : ($match['team_a_goals'] == $match['team_b_goals'] ? 1 : 0);
            }
        }

        return $teamAPoints <=> $teamBPoints;
    }
}
