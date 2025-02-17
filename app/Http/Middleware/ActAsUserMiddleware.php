<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActAsUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isProduction()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            Auth::loginUsingId(1);
        }

        return $next($request);
    }
}
