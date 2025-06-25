@component('mail::message')
# Réinitialisation de mot de passe

Bonjour {{ $user->name }},

Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe.

@component('mail::button', ['url' => $url])
Réinitialiser mon mot de passe
@endcomponent

Ce lien expirera dans {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutes.

Si vous n'avez pas demandé cette réinitialisation, ignorez simplement cet email.
@endcomponent
