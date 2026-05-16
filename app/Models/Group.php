<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    // Définir les champs éligibles à l'assignation de masse
    protected $fillable = ['name', 'level', 'year'];

    /**
     * Un groupe possède plusieurs étudiants (users).
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Un groupe possède plusieurs séances d'emploi du temps.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
