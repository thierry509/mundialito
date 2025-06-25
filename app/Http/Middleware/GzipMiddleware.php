<?php

namespace App\Http\Middleware;

use Closure;

class GzipMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (in_array('gzip', explode(',', $request->header('Accept-Encoding')))) {
            $content = $response->content();
            $compressed = gzencode($content, 9);

            $response->setContent($compressed);
            $response->headers->add([
                'Content-Encoding' => 'gzip',
                'Content-Length' => strlen($compressed),
            ]);
        }

        return $response;
    }
}
