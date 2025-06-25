@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
        style="background-image: url({{ asset('images/stadium.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

        <div class="w-full lg:w-4/6 bg-white p-8 rounded-xl shadow-2xl backdrop-blur-sm text-center">
            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>

            <h2 class="mt-4 text-2xl font-bold text-gray-800">Lien envoyé !</h2>
            <p class="mt-2 text-gray-600">Un lien de réinitialisation du mot de passe a été envoyé à votre adresse email.</p>

            <!-- Resend Email Link -->
            <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Renvoyer le lien
                </button>
            </form>

            <!-- Retour connexion -->
            <div class="mt-6">
                <a href="{{ route('login') }}" class="text-sm font-medium text-primary hover:text-secondary">
                    Retour à la page de connexion
                </a>
            </div>
        </div>
    </div>
@endsection
