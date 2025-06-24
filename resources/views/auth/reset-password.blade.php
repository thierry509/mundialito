@extends('layout.app')
@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
        style="background-image: url({{ asset('images/stadium.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

        <div class="w-full lg:w-2/6 bg-white p-8 rounded-xl shadow-2xl backdrop-blur-sm">
            <!-- Header -->
            <div class="text-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Réinitialisez votre mot de passe</h1>
                <p class="text-gray-600 mt-2">Choisissez un nouveau mot de passe sécurisé</p>
            </div>

            <!-- Reset Form -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('password.reset.post') }}" class="space-y-6">
                @csrf

                <!-- Hidden Inputs -->
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="********">
                    </div>
                    @error('password')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de
                        passe</label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="********">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary/90 hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>

            <!-- Back to login -->
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-primary hover:text-secondary">
                    Retour à la connexion
                </a>
            </div>
        </div>
    </div>
@endsection
