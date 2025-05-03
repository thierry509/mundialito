<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
