<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Contrôleur d'authentification CSFT.
 * Gère : affichage login, connexion avec redirection par rôle, déconnexion.
 */
class AuthController extends Controller
{
    /**
     * Affiche la page de connexion.
     * Redirige vers le dashboard si déjà connecté.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect($this->redirectByRole());
        }

        return view('auth.login');
    }

    /**
     * Traite le formulaire de connexion.
     * Redirige vers l'espace approprié selon le rôle de l'utilisateur.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->redirectByRole());
    }

    /**
     * Déconnecte l'utilisateur et redirige vers la page de login.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Vous avez été déconnecté.');
    }

    /**
     * Détermine la route de redirection selon le rôle de l'utilisateur connecté.
     */
    private function redirectByRole(): string
    {
        return match (Auth::user()->role) {
            'student' => route('student.dashboard'),
            'teacher' => route('teacher.dashboard'),
            'admin'   => route('admin.dashboard'),
            default   => '/',
        };
    }
}
