@extends('layout.app')

@section('content')
    <div
        class="min-h-screen bg-light flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-[url('https://img.freepik.com/photos-gratuite/concept-faire-du-sport_23-2151937746.jpg?ga=GA1.1.90895242.1736884756&semt=ais_hybrid&w=740')]">
        <div class="w-7/10 w-full space-y-8 bg-white p-10 rounded-lg shadow-xl">
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
                                    Identifiants incorrects ou compte inexistant
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first-name" class="sr-only">Prénom</label>
                            <input id="first-name" name="first_name" type="text" autocomplete="given-name" required
                                class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                                placeholder="Prénom">
                            @error('name')
                                <span class="text-xs text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="last-name" class="sr-only">Nom</label>
                            <input id="last-name" name="last_name" type="text" autocomplete="family-name" required
                                class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                                placeholder="Nom">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                            placeholder="Adresse email">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                            placeholder="Mot de passe (min. 8 caractères)">
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
                    <input id="terms" name="terms" type="checkbox"
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

            <div class="text-center">
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
