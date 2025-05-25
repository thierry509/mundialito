<?php

namespace App\Services;

use App\Models\Championship;
use App\Models\Group;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
            ->map(function ($group) {
                $group->teams->each(function ($team) {
                    if ($team->viewRanking) {
                        $ranking = $team->viewRanking->first();
                        if ($ranking) {
                            foreach ($ranking->toArray() as $key => $value) {
                                if ($key !== 'team_id' && $key !== 'id') {
                                    $team->$key = $value;
                                }
                            }
                        }
                        unset($team->viewRanking);
                    }
                });
                $group->teams = $this->sortTeams($group->teams->toArray());
                // echo ($group->teams);

                return $group;
            });
    }

    /**
     * Trie un tableau d'équipes selon des règles de classement footballistiques
     *
     * @param array $teams Tableau d'équipes à trier
     * @param array $rules Règles de tri personnalisées (par défaut: FIFA standard)
     * @return array Tableau trié
     */
    function sortTeams(array $teams, ?array $rules = null): array
    {
        // Règles par défaut (ordre FIFA standard)
        $defaultRules = [
            'points' => 'desc',
            'goalDifference' => 'desc',
            'goalsFor' => 'desc',
            'fair_play_points' => 'asc',
            'name' => 'asc',
        ];

        $rules = $rules ?? $defaultRules;

        usort($teams, function ($a, $b) use ($rules) {
            foreach ($rules as $field => $order) {
                // Récupère les valeurs à comparer
                $valueA = $a[$field] ?? 0;
                $valueB = $b[$field] ?? 0;

                // Convertit les chaînes numériques en nombres
                if (is_numeric($valueA)) $valueA = (float)$valueA;
                if (is_numeric($valueB)) $valueB = (float)$valueB;

                // Compare selon l'ordre spécifié
                if ($valueA != $valueB) {
                    if ($order === 'desc') {
                        return $valueA > $valueB ? -1 : 1;
                    } else {
                        return $valueA < $valueB ? -1 : 1;
                    }
                }
            }
            return 0; // égalité sur tous les critères
        });

        return $teams;
    }
}
