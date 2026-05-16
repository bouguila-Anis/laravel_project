<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'string', 'in:student,teacher'], // L'admin est créé par seeder uniquement
            'group_id' => ['required_if:role,student', 'nullable', 'exists:groups,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Le nom complet est obligatoire.',
            'email.required'        => 'L\'adresse email est obligatoire.',
            'email.email'           => 'L\'adresse email doit être valide.',
            'email.unique'          => 'Cette adresse email est déjà enregistrée.',
            'password.required'     => 'Le mot de passe est obligatoire.',
            'password.confirmed'    => 'Les deux mots de passe ne correspondent pas.',
            'role.required'         => 'Veuillez sélectionner votre profil.',
            'group_id.required_if'  => 'Le groupe est obligatoire pour les étudiants.',
        ];
    }
}
