<?php

namespace AlexBowers\MultipleDashboard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use AlexBowers\MultipleDashboard\MultipleDashboard;

class Authorize
{
    public function handle(Request $request, Closure $next): Response
    {
        return app(MultipleDashboard::class)->authorize($request)
            ? $next($request)
            : abort(403);
    }
}
