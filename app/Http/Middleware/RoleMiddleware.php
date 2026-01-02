<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            $roleArray = explode('|', $role);
            if (in_array($user->role, $roleArray)) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki hak akses.');
    }
}
