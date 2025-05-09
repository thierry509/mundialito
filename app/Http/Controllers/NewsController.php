<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Models\News;
use Faker\Calculator\Inn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
        // return view('news.create');
        return Inertia::render('NewsForm');
    }

    public function store(StoreNewsRequest $request)
    {
       // Validation des données
        $validatedData = $request->validated();

        // Gestion de l'upload de l'image
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('news_images', 'public');
        }

        // Création de la news
        $news = News::create([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'content' => $validatedData['content'],
            'image_url' => $imagePath ? '/storage/' . $imagePath : null,
            'user_id' => 1,
        ]);

        return redirect()->route('news.show', $news->id)
                         ->with('success', 'News créée avec succès!');
    }
}
