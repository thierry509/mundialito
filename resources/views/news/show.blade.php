@extends('layout.app')

@section('content')
    <style>
        /* Styles Quill par défaut */
        .ql-editor {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        .ql-editor a {
            color: #3182ce;
            text-decoration: underline;
        }

        .ql-editor ol,
        .ql-editor ul {
            padding-left: 1.5em;
        }

        .ql-editor ol {
            list-style-type: decimal;
        }

        .ql-editor ul {
            list-style-type: disc;
        }

        .ql-editor blockquote {
            border-left: 4px solid #ccc;
            padding-left: 1em;
            color: #555;
            font-style: italic;
        }
    </style>

    <!-- Hero Section for Article -->
    <x-hero title="Actualités" subtitle="{!! $news->title !!}" backgroundImage="/images/article-hero.jpg" variant="primary"
        haveYear="{{ false }}" :center="false" />


    <!-- Article Content -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Article Meta -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div class="flex items-center mb-4 md:mb-0">
                    <svg class="w-10 h-10 rounded-full mr-3 bg-gray-400 p-1" viewBox="0 0 16 16"
                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="m 8 1 c -1.65625 0 -3 1.34375 -3 3 s 1.34375 3 3 3 s 3 -1.34375 3 -3 s -1.34375 -3 -3 -3 z m -1.5 7 c -2.492188 0 -4.5 2.007812 -4.5 4.5 v 0.5 c 0 1.109375 0.890625 2 2 2 h 8 c 1.109375 0 2 -0.890625 2 -2 v -0.5 c 0 -2.492188 -2.007812 -4.5 -4.5 -4.5 z m 0 0"
                                fill="#2e3436"></path>
                        </g>
                    </svg>
                    <div>
                        <div class="font-medium">{{ $author->first_name }} {{ $author->last_name }}</div>
                        <div class="text-sm text-gray-500">Publié le {{ $news->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <span
                        class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">{{ $news->category->name }}</span>
                </div>
            </div>

            <!-- Featured Image -->
            @if ($news->image()->first())
                <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                    <img src="{{ $news->image()->first()->url }}" alt="{{ $news->image()->first()->description }}"
                        class="w-full h-[400px] object-cover">
                    <div class="text-xs text-gray-500 bg-light/50 p-2 text-center">
                        {{ $news->image()->first()->description }}</div>
                </div>
            @endif
            <!-- Article Body -->
            <article class="prose max-w-none prose-lg">
                <div class="ql-editor text-justify">
                    {!! Str::markdown(str_replace(['@markdown', '@endmarkdown'], '', $news->content)) !!}
                </div>
            </article>
            <!-- Article Footer -->
            <div class="border-t border-light pt-8 mt-12">
                {{-- <div class="flex flex-wrap gap-2 mb-6">
                    <a href="#" class="px-3 py-1 bg-light rounded-full text-sm hover:bg-light/80">#Lions</a>
                    <a href="#" class="px-3 py-1 bg-light rounded-full text-sm hover:bg-light/80">#Tigres</a>
                    <a href="#" class="px-3 py-1 bg-light rounded-full text-sm hover:bg-light/80">#Mundialito2023</a>
                    <a href="#" class="px-3 py-1 bg-light rounded-full text-sm hover:bg-light/80">#Journée1</a>
                </div> --}}

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        {{-- <button class="p-2 rounded-full bg-light hover:bg-light/80">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                </path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-full bg-light hover:bg-light/80">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </button> --}}
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Partager :</span>

                        @php
                            $shareUrl = route('news.show', $news->slug);
                            $shareText = urlencode('Check out this news: ' . $news->title);
                        @endphp

                        <!-- Facebook Share -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                            aria-label="Partager sur Facebook" target="_blank" rel="noopener noreferrer"
                            class="p-2 rounded-full bg-light hover:bg-light/80 transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                </path>
                            </svg>
                        </a>

                        <!-- Twitter Share -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ $shareText }}"
                            aria-label="Partager sur Twitter" target="_blank" rel="noopener noreferrer"
                            class="p-2 rounded-full bg-light hover:bg-light/80 transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                </path>
                            </svg>
                        </a>

                        <!-- WhatsApp Share -->
                        <a href="https://wa.me/?text={{ $shareText }}%20{{ urlencode($shareUrl) }}"
                            aria-label="Partager sur WhatsApp" target="_blank" rel="noopener noreferrer"
                            class="p-2 rounded-full bg-light hover:bg-light/80 transition-colors duration-200">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6">Articles similaires</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedNews as $news)
                        <article
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            @if ($news->image()->first())
                                <img class="w-full h-40 object-cover" src="{{ $news->image()->first()->url }}"
                                    alt="{{ $news->image()->first()->description }}">
                            @endif

                            <div class="p-4">
                                <div class="text-xs text-gray-500 mb-2">{{ $news->created_at->diffForHumans() }}</div>
                                <h3 class="font-medium hover:text-primary transition duration-200">
                                    <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                </h3>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </div>
    </main>
@endsection
