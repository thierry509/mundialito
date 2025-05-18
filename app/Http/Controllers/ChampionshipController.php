<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChampionshipRequest;
use App\Models\Championship;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChampionshipController extends Controller
{
    public function store(StoreChampionshipRequest $request)
    {
        $validatedData = $request->validated();
        Championship::create([
            'year' => $validatedData['year'],
            'knockout_round' => $validatedData['knockout_round'],
        ]);
        return redirect()->route('dashboard')->with('success', 'Championat créé avec succès.');
    }
}
