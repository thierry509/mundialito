<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index');
    }

    public function show($slug)
    {
        return view('news.show', compact('slug'));
    }

    public function create(){
        return view('news.create');
    }
}
