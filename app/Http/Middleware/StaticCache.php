<?php

namespace App\Http\Middleware;

use Closure;

class StaticCache
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->is('images/*') || $request->is('uploads/*')) {
            $response->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        return $response;
    }
}
