@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
        style="background-image: url({{ asset('images/stadium.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

        <div class="w-full lg:w-3/6 bg-white p-8 rounded-xl shadow-2xl backdrop-blur-sm relative z-10">
            <!-- Header -->
            <div class="text-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12H8m0 0H4m4 0h12M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Vérifiez votre adresse email</h1>
                <p class="text-gray-600 mt-2">
                    Avant de continuer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de
                    vous envoyer.
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Si vous ne trouvez pas l’email, pensez à vérifier votre dossier <strong>spam</strong> ou
                    <strong>courrier indésirable</strong>.
                </p>

                <p class="mt-2 text-sm text-gray-800">
                    <strong>Adresse :</strong> {{ Auth::user()->email }}
                </p>
            </div>

            <!-- Success message -->
            @if (session('status') === 'verification-link-sent')
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                    Un nouveau lien de vérification a été envoyé à votre adresse email.
                </div>
            @endif

            <!-- Actions -->
            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4 text-center">
                @csrf
                <button type="submit"
                    class="w-full md:w-auto inline-flex justify-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Renvoyer l'email de vérification
                </button>
            </form>

            <div class="mt-6 text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-secondary underline">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
