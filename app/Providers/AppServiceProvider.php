<?php

namespace App\Providers;

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
    }
}
