<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\TeamGroupRequest;
use App\Models\Championship;
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

    public function adminIndex(Request $request)
    {
        $year = $request->query('year');
        return Inertia::render('Championship.Groupes', [
            'teams' => Team::whereDoesntHave('groupParticipations')->get(),
            'groups' => Group::with('teams')->whereHas('championship', function ($query) use ($year) {
                $query->where('year', $year);
            })->get(),
        ]);
    }

    public function addTeamToGroup(TeamGroupRequest $request)
    {
        $validated = $request->validated();
        $team = Team::findOrFail($validated['team_id']);
        $group = Group::findOrFail($validated['group_id']);

        $group->teams()->attach($request->team_id);

        return redirect()->back()->with('success', 'L\'équipe a été ajoutée au groupe avec succès.');
    }

    public function store(Request $request)
    {
        $year = $request->query('year');
        $championship = Championship::where('year', $year)->first();
        Group::create([
            'name' => $this->generateNextGroupName($championship->id, $year),
            'championship_id' => $championship->id,
        ]);
        return redirect()->back()->with('success', 'Groupe créé avec succès.');
    }
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect()->back()->with('success', 'Groupe supprimé avec succès.');
    }
    public function removeTeamFromGroup($group_id, $team_id)
    {
        $group = Group::findOrFail($group_id);
        $team = Team::findOrFail($team_id);

        if ($group->teams()->where('team_id', $team->id)->exists()) {
            $group->teams()->detach($team->id);
            return redirect()->back()->with('success', 'L\'équipe a été supprimée du groupe avec succès.');
        }
        return redirect()->back()->with('error', 'Cette équipe n\'est pas dans ce groupe.');
    }

    private function generateNextGroupName($championshipId, $year)
    {
        $count = Group::whereHas('championship', function ($query) use ($championshipId, $year) {
            $query->where('id', $championshipId)
                ->where('year', $year);
        })
            ->count();

        return chr(65 + $count);
    }
}
