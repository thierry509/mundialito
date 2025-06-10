<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EditController extends Controller
{
    public function show()
    {
        return Inertia::render('Dashboard', [
            'users' => User::where('roles', "admin")->get(),
        ]);
    }
}
