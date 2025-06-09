<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class HandleInertiaRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Si la requête vient d'Inertia
        if ($request->header('X-Inertia')) {
            // Cas 1 : Redirection
            if ($response->isRedirection()) {
                return Inertia::location($response->headers->get('Location'));
            }

            // Cas 2 : Réponse HTML inattendue (ex: une vue Blade comme login.blade.php)
            $contentType = $response->headers->get('Content-Type');

            if (str_starts_with($contentType, 'text/html')) {
                // On force un rechargement complet pour éviter document.write
                return Inertia::location($request->getRequestUri());
            }
        }

        return $response;
    }
}
