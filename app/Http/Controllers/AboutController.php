<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('A propos du mundialito ');
        SEOMeta::setDescription('Histoire et appelations du mundialito');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('A propos du mundialito ');
        OpenGraph::setDescription('Histoire et appelations du mundialito');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('A propos du mundialito ');
        TwitterCard::setDescription('Histoire et appelations du mundialito');
        TwitterCard::setUrl(url()->current());

        return view('about.index');
    }

    public function cgu()
    {
        return view('about.cgu');
    }
}
