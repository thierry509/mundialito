<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
