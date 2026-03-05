<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdminOrEntreprise
{
    /**
     * Gère la requête entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && ($user->role === 'admin' || $user->role === 'entreprise')) {
            return $next($request);
        }

        abort(403, 'Accès interdit : réservé aux administrateurs ou entreprises.');
    }
}
