@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
        style="background-image: url({{ asset('images/stadium.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

        <div class="w-full lg:w-4/6 bg-white p-8 rounded-xl shadow-2xl backdrop-blur-sm">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Mot de passe oublié ?</h1>
                <p class="text-gray-600 mt-2">Entrez votre email pour réinitialiser votre mot de passe</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="your@email.com">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary/90 hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Envoyer le lien de réinitialisation
                    </button>
                </div>
            </form>

            <!-- Back to login link -->
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-primary hover:text-secondary">
                    Vous vous souvenez de votre mot de passe ? Se connecter
                </a>
            </div>
        </div>

        <!-- Success message (hidden by default) -->
        <div id="successMessage" class="hidden mt-4 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        Password reset link sent! Check your email.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
