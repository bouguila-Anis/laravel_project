<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Routes CSFT — Espace Étudiant
| Phase 1 : Auth uniquement (les autres routes seront ajoutées en Phase 2+)
|--------------------------------------------------------------------------
*/

// ─────────────────────────────────────────────
// Racine → redirection vers login
// ─────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ─────────────────────────────────────────────
// Authentification (accessible sans être connecté)
// ─────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Routes pour l'inscription (Sign Up)
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─────────────────────────────────────────────
// Espace Étudiant
// ─────────────────────────────────────────────
Route::middleware(['auth', 'role:student'])
    ->prefix('espace-stagiaire')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

        // Phase 2 — à décommenter au fur et à mesure
        // Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
        // Route::get('/emploi-du-temps', [ScheduleController::class, 'index'])->name('schedule.index');
        // Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
        // Route::resource('demandes', DocumentRequestController::class)->only(['index','create','store']);
    });

// ─────────────────────────────────────────────
// Espace Formateur
// ─────────────────────────────────────────────
Route::middleware(['auth', 'role:teacher'])
    ->prefix('espace-formateur')
    ->name('teacher.')
    ->group(function () {
        Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');

        // Phase 3 — à décommenter
        // Route::get('/notes', [TeacherNoteController::class, 'index'])->name('notes.index');
        // Route::resource('supports', CourseController::class)->only(['index','create','store']);
    });

// ─────────────────────────────────────────────
// Espace Administrateur
// ─────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('administration')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Phase 4 — à décommenter
        // Route::resource('demandes', AdminDocumentController::class)->only(['index','update']);
        // Route::resource('notifications', NotificationController::class)->only(['index','create','store']);
    });
