<?php


namespace App\Services;

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     */
    public function registerUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // student ou teacher [cite: 10]
            'group_id' => $data['role'] === 'student' ? $data['group_id'] : null, // Seuls les étudiants ont un groupe [cite: 10]
        ]);
    }

    /**
     * Récupère la liste des groupes disponibles pour le formulaire d'inscription.
     */
    public function getAllGroups(): Collection
    {
        return Group::all();
    }
}
