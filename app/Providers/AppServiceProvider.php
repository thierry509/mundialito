<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Récupérez d'abord les données
        $years = \App\Models\Championship::orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
        $auth = Auth::user();

        // Partagez le tableau de résultats (pas la fonction)
        Inertia::share([
            'years' => $years,
            'auth' => function () {
                return [
                    'user' => Auth::user()?->only(['id', 'first_name', 'last_name', 'email', 'roles']),
                ];
            },
        ]);

        View::share([
            'years' => $years,
        ]);

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(config('app.name') . ' - Confirmation de votre adresse email')
                ->greeting('Bonjour ' . $notifiable->name . ' !')
                ->line('Merci de vous être inscrit. Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse email.')
                ->action('Vérifier mon email', $url)
                ->line("Si vous n'avez pas créé de compte, aucune action n'est requise.")
                ->salutation('Cordialement,<br>L\'équipe ' . config('app.name'));
        });
    }
}
