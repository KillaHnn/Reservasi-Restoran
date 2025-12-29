<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware(['auth', 'role:admin|cashier'])
     */
    public function handle(Request $request, Closure $next, ?string $roles = null)
    {
        $user = $request->user();

        // If there's no authenticated user, let 'auth' middleware handle it when used together.
        if (! $user) {
            abort(403);
        }

        if ($roles) {
            $allowed = explode('|', $roles);
            if (! in_array($user->role, $allowed, true)) {
                abort(403);
            }
        }

        return $next($request);
    }
}
