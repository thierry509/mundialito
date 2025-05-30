@extends('layout.app')

@section('content')
    <!-- Hero Section for Article -->
    <x-hero title="Actualités" subtitle="{{ $news->title }}" backgroundImage="/images/article-hero.jpg" variant="primary"
        :center="false" />


    <!-- Article Content -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Article Meta -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div class="flex items-center mb-4 md:mb-0">
                    <img class="w-10 h-10 rounded-full mr-3"
                        src="data:image/png;base64,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"
                        alt="Jean Bernard">
                    <div>
                        <div class="font-medium">{{ $author->first_name }} {{ $author->last_name }}</div>
                        <div class="text-sm text-gray-500">Publié le {{ $news->created_at }} • 5 min de lecture</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <span
                        class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">{{ $news->category }}</span>
                </div>
            </div>

            <!-- Featured Image -->
            @if ($news->image()->first())
                <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                    <img src="{{ $news->image()->first()->url }}" alt="{{ $news->image()->first()->description }}"
                        class="w-full h-auto">
                    <div class="text-xs text-gray-500 bg-light/50 p-2 text-center">Les Lions célèbrent leur premier but
                        (Photo:
                        Mundialito Press)</div>
                </div>
            @endif
            <!-- Article Body -->
            <article class="prose max-w-none prose-lg">
                {!! Str::markdown(str_replace(['@markdown', '@endmarkdown'], '', $news->content)) !!}            </article>
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
                        <button class="p-2 rounded-full bg-light hover:bg-light/80">
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
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Partager :</span>
                        <button class="p-2 rounded-full bg-light hover:bg-light/80">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                </path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-full bg-light hover:bg-light/80">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                </path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-full bg-light hover:bg-light/80">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold mb-6">Articles similaires</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img class="w-full h-40 object-cover"
                            src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2"
                            alt="Article similaire">
                        <div class="p-4">
                            <div class="text-xs text-gray-500 mb-2">16 Juillet 2023</div>
                            <h4 class="font-medium hover:text-primary transition duration-200">
                                <a href="#">Les Aigles s'imposent face aux Étoiles</a>
                            </h4>
                        </div>
                    </article>
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img class="w-full h-40 object-cover"
                            src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2"
                            alt="Article similaire">
                        <div class="p-4">
                            <div class="text-xs text-gray-500 mb-2">14 Juillet 2023</div>
                            <h4 class="font-medium hover:text-primary transition duration-200">
                                <a href="#">Analyse tactique des Lions</a>
                            </h4>
                        </div>
                    </article>
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img class="w-full h-40 object-cover"
                            src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2"
                            alt="Article similaire">
                        <div class="p-4">
                            <div class="text-xs text-gray-500 mb-2">12 Juillet 2023</div>
                            <h4 class="font-medium hover:text-primary transition duration-200">
                                <a href="#">Préparatifs des équipes avant le tournoi</a>
                            </h4>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </main>
@endsection
