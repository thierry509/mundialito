<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de l'upload de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        // Création de la news
        $news = News::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'date' => $validatedData['date'],
            'image_url' => $imagePath ? '/storage/' . $imagePath : null,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('news.show', $news->id)
                         ->with('success', 'News créée avec succès!');
    }
}
