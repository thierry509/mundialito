@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
        style="background-image: url({{ asset('images/stadium.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

        <div class="w-full lg:w-4/6 bg-white px-8 my-8 rounded-xl shadow-2xl backdrop-blur-sm">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Créer un compte
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Rejoignez la communauté du Mundialito
                </p>
            </div>
            @include('layout.partials.socialAuth')
            <form class="mt-8 space-y-6" action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first-name" class="sr-only">Prénom</label>
                            <input id="first-name" name="first_name" type="text" autocomplete="given-name" required value="{{ old('first_name') }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                                placeholder="Prénom">
                            @error('first_name')
                                <span class="text-xs text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="last-name" class="sr-only">Nom</label>
                            <input id="last-name" name="last_name" type="text" autocomplete="family-name" required value="{{ old('last_name') }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                                placeholder="Nom">

                            @error('last_name')
                                <span class="text-xs text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                            class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                            placeholder="Adresse email">
                        @error('email')
                            <span class="text-xs text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                            placeholder="Mot de passe (min. 8 caractères)">
                            @error('password')
                            <span class="text-xs text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <label for="confirm-password" class="sr-only">Confirmer le mot de passe</label>
                        <input id="confirm-password" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                            placeholder="Confirmer le mot de passe">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        J'accepte les <a href="{{ route('cgu') }}" class="text-primary hover:text-accent">conditions
                            d'utilisation</a>
                    </label>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        S'inscrire
                    </button>
                </div>
            </form>

            <div class="text-center pb-4">
                <p class="mt-4 text-sm text-gray-600">
                    Déjà un compte?
                    <a href="{{ route('login') }}" class="font-medium text-primary hover:text-accent">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
