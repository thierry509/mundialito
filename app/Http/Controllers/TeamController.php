<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminViewRequest;
use App\Http\Requests\DeleteTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function index()
    {
        return view('teams.index');
    }

    public function show($id)
    {
        return view('teams.show', compact('id'));
    }

    public function store(StoreTeamRequest $request)
    {
        $validated = $request->validated();
        Team::create([
            'name' => strtoupper($validated['name']),
            'location' =>  strtoupper($validated['location']),
        ]);

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }
    public function adminIndex(AdminViewRequest $request)
    {
        $teams = Team::all()->map(function ($team) {
            return [
                'id' => $team->id,
                'name' => strtoupper($team->name),
                'location' => strtoupper($team->location),
                'has_relations' => $team->hasAnyRelations(),
            ];
        });

        return Inertia::render('Team/Index', [
            'teams' => $teams,
        ]);
    }


    public function destroy(DeleteTeamRequest $request)
    {

        $team = Team::findOrFail($request->validated()['id']);
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}
