<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdminOrCandidat
{
    /**
     * Gère la requête entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && ($user->role === 'admin' || $user->role === 'candidat')) {
            return $next($request);
        }

        abort(403, 'Accès interdit : réservé aux administrateurs ou candidats.');
    }
}
