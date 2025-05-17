<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class KnockoutController extends Controller
{
    public function index()
    {
        return view('knockout.index');
    }

    public function adminIndex()
    {
        return Inertia::render('Championship.Knockout', []);
    }
}
