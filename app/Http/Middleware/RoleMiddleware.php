<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roleId): Response
    {
        if (!auth()->check() || auth()->user()->rolId != $roleId) {
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
}
