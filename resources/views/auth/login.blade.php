@extends('layout.app')

@section('content')
<div class="min-h-screen bg-light flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[url('https://img.freepik.com/photos-gratuite/concept-faire-du-sport_23-2151937746.jpg?ga=GA1.1.90895242.1736884756&semt=ais_hybrid&w=740')] bg-cover bg-center">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-xl">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-bold text-gray-900">
                Connexion à votre compte
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Accédez au suivi complet du Mundialito
            </p>
        </div>
        <form class="mt-8 space-y-6" action="#" method="POST">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                        placeholder="Adresse email">
                </div>
                <div>
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                        placeholder="Mot de passe">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Se souvenir de moi
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-accent">
                        Mot de passe oublié?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                    Se connecter
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="mt-4 text-sm text-gray-600">
                Pas encore de compte?
                <a href="{{ route('register') }}" class="font-medium text-primary hover:text-accent">
                    Créer un compte
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
