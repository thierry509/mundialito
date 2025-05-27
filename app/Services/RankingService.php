<?php

namespace App\Services;

use App\Models\Championship;
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
        $rankingRules = Championship::where('year', $year)->with('rankingRules')->first()->rankingRules->pluck('position', 'code');


        $rules = $rules ?? $rankingRules;
        $teamArray = $teams->all();

        usort($teamArray, function ($a, $b) use ($rules) {
            foreach ($rules as $field => $order) {
                $valueA = $a->$field ?? 0;
                $valueB = $b->$field ?? 0;

                // Si c'est numérique, forcer la comparaison numérique
                if (is_numeric($valueA)) $valueA = (float) $valueA;
                if (is_numeric($valueB)) $valueB = (float) $valueB;

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

        return collect($teamArray)->values(); // <= ajout de ->values()
    }
}
