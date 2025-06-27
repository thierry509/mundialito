<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\DeleteNewsRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\Images;
use App\Models\News;
use App\Services\ImageService;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Actualites du mundialito ');
        SEOMeta::setDescription('Listes des actualites du mundialito');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Actualites du mundialito ');
        OpenGraph::setDescription('Listes des actualites du mundialito');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setTitle('Actualites du mundialito ');
        TwitterCard::setDescription('Listes des actualites du mundialito');
        TwitterCard::setUrl(url()->current());


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
        $news = News::where('slug', $slug)
        ->firstOrFail();
        // $data = Cache::remember($cacheKey, now()->addHours(2), function () use ($slug) {

        SEOMeta::setTitle('Actualite - ' . $news->title);
        SEOMeta::setDescription('Description ' . $news->excerpt);
        SEOMeta::setCanonical(url()->current());


        OpenGraph::setTitle('Actualite - ' . $news->title);
        OpenGraph::setDescription('Description ' . $news->excerpt);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addImage($news->image?->url ?? asset('/images/mundialito.jpg'), [
            'width' => 1200,
            'height' => 630,
        ]);

        TwitterCard::setTitle('Actualite - ' . $news->title);
        TwitterCard::setDescription('Description ' . $news->excerpt);
        TwitterCard::setUrl(url()->current());
        TwitterCard::setImage($news->image?->url ?? asset('/images/mundialito.jpg'));

        $author = $news->user;
        $category = $news->category;
        $data = [
            'news' => $news,
            'author' => $author,
            'category' => $category,
            'relatedNews' => News::where(function ($query) use ($news) {
                $query->where('category_id', $news->category_id)
                    ->where('id', '!=', $news->id);
            })
                ->orWhere(function ($query) use ($news) {
                    $query->where('category_id', '!=', $news->category_id)
                        ->where('id', '!=', $news->id);
                })
                ->latest()
                ->take(3)
                ->get(),
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
        Gate::authorize('create', News::class);
        return Inertia::render('News.Edit', [
            'categories' => $categories,
        ]);
    }

    public function edit($slug)
    {

        $news = News::with('image')->where('slug', $slug)->firstOrFail();
        Gate::authorize('update', $news);
        $categories = Category::all();

        return Inertia::render('News.Edit', [
            'news' => $news,
            'categories' => $categories,
        ]);
    }


    public function adminIndex()
    {
        $news = News::with(['user', 'category', 'image'])
        ->latest()
        ->where('user_id', Auth::user()->id)
        ->get() // Récupère tous les résultats sans pagination
        ->map(function ($item) { // Utilisez map() au lieu de through() pour les collections
            return [
                ...$item->toArray(),
                'created_at_local' => $item->created_at->diffForHumans(), // Format "il y a X temps"
            ];
        });
        return Inertia::render('News.Index', [
            'news' => $news,
        ]);
    }
    public function store(StoreNewsRequest $request, ImageService $imageService)
    {
        // Validation des données
        $validatedData = $request->validated();
        // Gate::authorize('create', News::class);
        // Gestion de l'upload de l'image
        DB::transaction(function () use ($validatedData, $request, $imageService) {
            $image = null;
            $slug = $this->manage_slug($validatedData['slug']);
            $category = Category::find($validatedData['category']);
            if ($request->hasFile('featured_image')) {
                $imageUrls = $imageService->store($request->file('featured_image'), $validatedData['image_description']);

                $image = Images::create([
                    'url' => $imageUrls['original'] ? '/storage/' . $imageUrls['original'] : null,
                    'min_url' => $imageUrls['thumbnail'] ? '/storage/' . $imageUrls['thumbnail'] : null,
                    'description' => $validatedData['image_description']
                ]);
            }
            $news = News::create([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'category_id' => $category->id,
                'excerpt' => $validatedData['excerpt'],
                'content' => $validatedData['content'],
                'image_id' => $image?->id,
                'video_url' => $validatedData['video_url'],
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function update(UpdateNewsRequest $request, ImageService $imageService, $slug)
    {

        $validatedData = $request->validated();
        $news = News::where('slug', $slug)->firstOrFail();
        Gate::authorize('update', $news);

        DB::transaction(function () use ($validatedData, $request, $imageService, &$news) {
            $image = null;
            $slug = $this->manage_slug($validatedData['slug']);
            $category = Category::find($validatedData['category']);

            if ($request->hasFile('featured_image')) {

                if ($news->image) {
                    // Delete the old image
                    $oldImage = $news->image;
                    $imageUrls = $imageService->update($request->file('featured_image'), $validatedData['image_description'], $oldImage->url, $oldImage->min_url);

                    $news->image->update([
                        'url' => $imageUrls['original'] ? '/storage/' . $imageUrls['original'] : null,
                        'min_url' => $imageUrls['thumbnail'] ? '/storage/' . $imageUrls['thumbnail'] : null,
                        'description' => $validatedData['image_description']
                    ]);
                    $image = $news->image;
                } else {
                    $imageUrls = $imageService->store($request->file('featured_image'), $validatedData['image_description']);

                    $image = Images::create([
                        'url' => $imageUrls['original'] ? '/storage/' . $imageUrls['original'] : null,
                        'min_url' => $imageUrls['thumbnail'] ? '/storage/' . $imageUrls['thumbnail'] : null,
                        'description' => $validatedData['image_description']
                    ]);
                }
            }

            $news->update([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'category_id' => $category?->id,
                'excerpt' => $validatedData['excerpt'],
                'content' => $validatedData['content'],
                'video_url' => $validatedData['video_url'],
                'image_id' => $image->id ?? $image?->id,
            ]);
        });
        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }


    public function destroy(DeleteNewsRequest $request)
    {
        $news = News::where('slug', $request->slug)->firstOrFail();
        $news->delete();
        return redirect()->back()->with('success', 'News deleted successfully.');
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
}
