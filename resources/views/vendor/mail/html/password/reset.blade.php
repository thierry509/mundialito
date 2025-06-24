@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- Votre logo ici -->
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" style="height: 50px;">
        @endcomponent
    @endslot

    <!-- Email Body -->
    <h1 style="color: #2d3748; font-size: 24px;">Réinitialisation de votre mot de passe</h1>

    <p style="color: #4a5568; line-height: 1.5;">
        Vous recevez cet email parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.
    </p>

    @component('mail::button', ['url' => $url, 'color' => 'primary'])
        Réinitialiser le mot de passe
    @endcomponent

    <p style="color: #4a5568; line-height: 1.5;">
        Ce lien de réinitialisation expirera dans {{ config('auth.passwords.'.config('auth.defaults.passwords').expire') }} minutes.
    </p>

    <p style="color: #4a5568; line-height: 1.5;">
        Si vous n'avez pas demandé de réinitialisation, aucune action n'est requise.
    </p>

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
        @endcomponent
    @endslot
@endcomponent
