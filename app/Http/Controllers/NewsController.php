<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Models\Category;
use App\Models\Images;
use App\Models\News;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['user', 'category'])
            ->latest()
            ->paginate(5);

        $topNews = News::with(['user', 'category'])
            ->latest()
            ->take(3)
            ->get();

        return view('news.index', [
            'news' => $news,
            'topNews' => $topNews,
        ]);
    }

    public function show($slug)
    {
        $cacheKey = "news_{$slug}";

        // $data = Cache::remember($cacheKey, now()->addHours(2), function () use ($slug) {
        $news = News::where('slug', $slug)
            ->firstOrFail();
        $author = $news->user;
        $category = $news->category;
        $data = [
            'news' => $news,
            'author' => $author,
            'category' => $category,
            // 'relatedNews' => News::where('category_id', $news->category_id)
            //                     ->where('id', '!=', $news->id)
            //                     ->latest()
            //                     ->take(3)
            //                     ->get(),
            'meta' => [
                'title' => $news->title,
                'description' => Str::limit(strip_tags($news->content), 160)
            ]
        ];
        // });

        return view('news.show', $data);
    }

    public function create()
    {
        // Récupération des catégories
        $categories = Category::all();
        return Inertia::render('News.Edit', [
            'categories' => $categories,
        ]);
    }

    public function edit($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return Inertia::render('News.Edit', [
            'news' => $news,
            'categories' => $categories,
        ]);
    }

    public function update(StoreNewsRequest $request, ImageService $imageService, $slug)
    {
        $validatedData = $request->validated();
        $news = News::where('slug', $slug)->firstOrFail();
        DB::transaction(function () use ($validatedData, $request, $imageService, &$news) {
            $image = null;
            $slug = $this->manage_slug($validatedData['slug']);
            $category = Category::find($validatedData['category']);

            if ($request->hasFile('featured_image')) {

                $imageUrls = $imageService->store($request->file('featured_image'), $validatedData['image_description']);

                $image->update([
                    'url' => $imageUrls['original'] ? '/storage/' . $imageUrls['original'] : null,
                    'min' => $imageUrls['thumbnail'] ? '/storage/' . $imageUrls['thumbnail'] : null,
                    'description' => $validatedData['image_description']
                ]);
            }


            $news->update([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'category_id' => $category?->id,
                'excerpt' => $validatedData['excerpt'],
                'content' => $validatedData['content'],
                'image_id' => $image?->id,
                'user_id' => 1,
            ]);

            return redirect()->back();
        });
    }

    public function adminIndex()
    {
        $news = News::with(['user', 'category', 'image'])
            ->latest()
            ->paginate(5)->where('user_id', Auth::user()->id);

        return Inertia::render('News.Index', [
            'news' => $news,
        ]);
    }
    public function store(StoreNewsRequest $request, ImageService $imageService)
    {
        // Validation des données
        $validatedData = $request->validated();

        // Gestion de l'upload de l'image

        DB::transaction(function () use ($validatedData, $request, $imageService) {
            $image = null;
            $slug = $this->manage_slug($validatedData['slug']);
            $category = Category::find($validatedData['category']);

            if ($request->hasFile('featured_image')) {
                $imageUrls = $imageService->store($request->file('featured_image'), $validatedData['image_description']);

                $image = Images::create([
                    'url' => $imageUrls['original'] ? '/storage/' . $imageUrls['original'] : null,
                    'min' => $imageUrls['thumbnail'] ? '/storage/' . $imageUrls['thumbnail'] : null,
                    'description' => $validatedData['image_description']
                ]);
            }


            $news = News::create([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'category_id' => $category?->id,
                'excerpt' => $validatedData['excerpt'],
                'content' => $validatedData['content'],
                'image_id' => $image?->id,
                'user_id' => 1,
            ]);

            return to_route('dashboard');
        });
    }

    private function manage_slug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . random_int(1000, 9999);
        }

        return $slug;
    }

    private function manageImage($imageData) {}
}
