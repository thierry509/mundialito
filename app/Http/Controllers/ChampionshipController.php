<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminViewRequest;
use App\Http\Requests\ChampionshipSettingRequest;
use App\Http\Requests\StoreChampionshipRequest;
use App\Models\Championship;
use App\Models\RankingRule;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ChampionshipController extends Controller
{
    public function index(Request $request)
    {
        SEOMeta::setTitle('Palmarès du Mundialito - Tous les Champions depuis sa Création');
        SEOMeta::setDescription('Retrouvez la liste complète des vainqueurs du Mundialito Gonaïves depuis sa première édition.');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Palmarès du Mundialito - Tous les Champions depuis sa Création');
        OpenGraph::setDescription('Retrouvez la liste complète des vainqueurs du Mundialito Gonaïves depuis sa première édition.');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('Palmarès du Mundialito - Tous les Champions depuis sa Création');
        TwitterCard::setDescription('Retrouvez la liste complète des vainqueurs du Mundialito Gonaïves depuis sa première édition.');
        TwitterCard::setUrl(url()->current());

        return view('prizeList.index');
    }
    public function store(StoreChampionshipRequest $request)
    {
        $validatedData = $request->validated();
        DB::transaction(function () use ($validatedData) {
            // Création du championnat
            $championship = Championship::create([
                'year' => $validatedData['year'],
                'knockout_round' => $validatedData['knockout_round'],
            ]);

            // Ajout des règles de classement par défaut
            $defaultRules = [
                ['code' => 'points', 'position' => 1],
                ['code' => 'diff_buts', 'position' => 2],
                ['code' => 'buts_marques', 'position' => 3],
            ];

            foreach ($defaultRules as $rule) {
                $rankingRule = RankingRule::where('code', $rule['code'])->first();

                if ($rankingRule) {
                    $championship->rankingRules()->attach($rankingRule->id, [
                        'position' => $rule['position']
                    ]);
                }
            }
        });
        return redirect()->route('dashboard')->with('success', 'Championat créé avec succès.');
    }

    public function setting(AdminViewRequest $request)
    {
        $year = $request->query('year');
        $rankingRules = RankingRule::All();
        $championship = Championship::with(['rankingRules'])->where('year', $year)->first();
        return Inertia::render('Championship.Setting', [
            'allRankingRules' => $rankingRules,
            'championship' => $championship,
        ]);
    }

    public function updateSettings(ChampionshipSettingRequest $request)
    {
        $year = $request->query('year');
        $championship = $championship = Championship::where('year', $year)->first();
        DB::transaction(function () use ($request, $championship) {
            // Mettre à jour le knockout round
            $championship->update([
                'knockout_round' => $request->knockout_round
            ]);

            // Récupérer les IDs correspondant aux codes
            $rulesToSync = collect($request->ranking_rules)->mapWithKeys(function ($rule) {
                $ruleModel = RankingRule::where('code', $rule['code'])->first();
                return [$ruleModel->id => ['position' => $rule['position']]];
            });

            $championship->rankingRules()->sync($rulesToSync->toArray());
        });

        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès');
    }
}
