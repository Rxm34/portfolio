<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isCandidat
{
    /**
     * Gère la requête entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->role === 'candidat') {
            return $next($request);
        }

        abort(403, 'Accès interdit : réservé aux candidats.');
    }
}
