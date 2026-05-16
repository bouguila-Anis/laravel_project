<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Modèle User provisoire — Phase 1 (Auth uniquement)
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'matricule',
        'group_name',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    // ─────────────────────────────────────────────
    // Helpers de rôle — utilisés dans les vues Blade et les middlewares
    // ─────────────────────────────────────────────

    /** Vérifie si l'utilisateur est un stagiaire */
    /**
     * L'étudiant appartient à un groupe.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /** Vérifie si l'utilisateur est un formateur */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /** Vérifie si l'utilisateur est un administrateur */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Retourne le nom lisible du rôle (pour affichage en vue)
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'student' => 'Stagiaire',
            'teacher' => 'Formateur',
            'admin'   => 'Administrateur',
            default   => 'Inconnu',
        };
    }

}
