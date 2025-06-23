<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Models\News;

class SitemapController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();

        $xml = view('sitemap', compact('news'))->render();

        return Response::make($xml, 200)->header('Content-Type', 'application/xml');
    }
}

