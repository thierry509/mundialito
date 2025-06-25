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
        SEOMeta::setTitle('Histoire du Mundialito - Championnat de Football des Gonaïves');
        SEOMeta::setDescription('Découvrez l’origine du Mundialito, son créateur et pourquoi ce tournoi est devenu un événement incontournable en Haïti.');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Histoire du Mundialito - Championnat de Football des Gonaïves');
        OpenGraph::setDescription('Découvrez l’origine du Mundialito, son créateur et pourquoi ce tournoi est devenu un événement incontournable en Haïti.');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('Histoire du Mundialito - Championnat de Football des Gonaïves');
        TwitterCard::setDescription('Découvrez l’origine du Mundialito, son créateur et pourquoi ce tournoi est devenu un événement incontournable en Haïti.');
        TwitterCard::setUrl(url()->current());

        return view('about.index');
    }

    public function cgu()
    {
        return view('about.cgu');
    }
}
