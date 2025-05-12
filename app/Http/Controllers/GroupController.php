<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamGroupRequest;
use App\Models\Group;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups.index');
    }


    public function adminIndex()
    {
        return Inertia::render('Championship.Groupes', [
            'teams' => Team::whereDoesntHave('groupParticipations')->get(),
            'groups' => Group::with('teams')->get(),
        ]);
    }

    public function addTeamToGroup(TeamGroupRequest $request)
    {
        $validated = $request->validated();
        $team = Team::findOrFail($validated['team_id']);
        $group = Group::findOrFail($validated['group_id']);



        if ($team->whereHas('groupParticipations')->exists()) {
            return redirect()->back()->with('error', 'Cette équipe est déjà assignée à un groupe.');
        }

        $group->teams()->attach($request->team_id);

        return redirect()->back()->with('success', 'L\'équipe a été ajoutée au groupe avec succès.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Group::create($validated);
        return redirect()->back()->with('success', 'Groupe créé avec succès.');
    }
}
