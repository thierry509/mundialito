<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use Illuminate\Support\Facades\Response;
use App\Models\News;

class SitemapController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        $years = \App\Models\Championship::all('year');

        $xml = view('sitemap', compact('news', 'years'))->render();

        return Response::make($xml, 200)->header('Content-Type', 'application/xml');
    }
}
