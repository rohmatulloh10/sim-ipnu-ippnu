<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {

        $user = $request->user();

        abort_unless($user, 401);

        $userRole = $user->role?->name;

        abort_unless(
            $userRole && in_array($userRole, $roles, true),
            403,
            'Anda tidak memiliki hak akses.'
        );

        return $next($request);
    }
}
