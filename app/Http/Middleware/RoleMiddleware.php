<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware RoleMiddleware — Protège les routes selon le rôle de l'utilisateur.
 *
 * Usage dans les routes :
 *   ->middleware('role:student')
 *   ->middleware('role:teacher,admin')
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Vérifier que l'utilisateur est connecté
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Vérifier que le compte est actif
        if (! $user->is_active) {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Votre compte a été désactivé.']);
        }

        // Vérifier que le rôle de l'utilisateur est autorisé
        if (! in_array($user->role, $roles)) {
            abort(403, 'Accès non autorisé à cet espace.');
        }

        return $next($request);
    }
}
