<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Afficher le formulaire d'inscription.
     */
    public function create(): View
    {
        $groups = $this->userService->getAllGroups();
        return view('auth.register', compact('groups'));
    }

    /**
     * Traiter la demande d'inscription.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        // Validation automatique grâce à RegisterRequest
        $user = $this->userService->registerUser($request->validated());

        // Connexion automatique de l'utilisateur après inscription
        Auth::login($user);

        // Redirection dynamique selon le rôle
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard'); // À créer en Phase 3
        }

        return redirect()->route('login');
    }
}
