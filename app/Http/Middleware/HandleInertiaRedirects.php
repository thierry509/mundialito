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

        // Si la requête est Inertia et qu'on a une redirection HTTP (302, 303, etc.)
        if (
            $request->header('X-Inertia') &&
            $response->isRedirection() &&
            in_array($response->getStatusCode(), [301, 302, 303])
        ) {
            // On force un vrai rechargement vers la nouvelle URL
            return Inertia::location($response->headers->get('Location'));
        }

        return $response;
    }
}
