<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration provisoire — Table users uniquement
 * Utilisée pour le système de login et la gestion des rôles.
 * À terme, cette table sera liée à la base existante du CSFT.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Informations de base
            $table->string('name');                          // Nom complet affiché
            $table->string('email')->unique();               // Email de connexion
            $table->string('password');

            // Rôle — détermine l'espace accessible après login
            $table->enum('role', ['student', 'teacher', 'admin'])->default('student');

            // Identifiant métier (optionnel pour la phase provisoire)
            // Permettra plus tard de faire la jointure avec la base existante du CSFT
            $table->string('matricule')->nullable()->unique(); // ex: BTS125-01
            $table->string('group_name')->nullable();          // ex: BTS TSMM 125

            // Statut du compte
            $table->boolean('is_active')->default(true);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
