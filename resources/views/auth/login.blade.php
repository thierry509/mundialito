@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
        style="background-image: url({{ asset('images/stadium.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

        <div class="w-full lg:w-4/6 bg-white p-8 rounded-xl shadow-2xl backdrop-blur-sm">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Connexion
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Accédez à votre espace Mundialito
                </p>
            </div>
            @include('layout.partials.socialAuth')
            <form class="mt-8 space-y-6" action="{{ route('login.submit') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors placeholder-gray-400"
                            placeholder="email@exemple.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 outline-none focus:ring-primary focus:border-primary transition-colors placeholder-gray-400"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-primary hover:text-accent underline">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 text-center text-sm">
                <p class="text-gray-600">
                    Nouveau sur Mundialito ?
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-accent underline">
                        Créer un compte
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
