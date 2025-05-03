<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KnockoutController extends Controller
{
    public function index()
    {
        return view('knockout.index');
    }
}
