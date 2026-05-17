<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== strtolower($role)) {
            abort(403, 'Unauthorized access. You do not have the required role.');
        }

        // Set the PostgreSQL session variable for database trigger security
        // We use set_config() because PostgreSQL SET command does not accept parameter binding directly
        DB::statement("SELECT set_config('app.current_role', ?, false)", [$request->user()->role]);

        return $next($request);
    }
}
