@extends('layout.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Image de fond avec effet de parallaxe -->
    <div class="absolute inset-0 bg-[url('https://cdn.pixabay.com/photo/2020/01/12/16/57/stadium-4760441_1280.jpg')] bg-cover bg-center bg-no-repeat transform transition duration-1000 ease-in-out scale-100 hover:scale-105">
    </div>

    <!-- Overlay sombre -->
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm z-10"></div>

    <!-- Contenu -->
    <div class="relative z-20 w-full max-w-md mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-xl rounded-2xl p-8 text-white">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-center mb-2 text-white drop-shadow">
                @yield('title')
            </h2>

            <p class="text-center text-gray-200 mb-6">
                @yield('message')
            </p>

            <div class="text-sm text-gray-300 text-center mb-6">
                @yield('details')
            </div>

            <a href="{{ url('/') }}"
                class="block w-full text-center bg-green-600 hover:bg-green-700 transition-all duration-300 text-white font-semibold py-2 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
