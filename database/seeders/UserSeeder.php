<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Récupérer l'ID du groupe BTS TSMM 125 que vous avez créé manuellement
        $group = Group::where('name', 'BTS TSMM 125')->first();
        $groupId = $group ? $group->id : null;

        // ─────────────────────────────────────────────
        // ADMINISTRATEURS
        // ─────────────────────────────────────────────
        User::create([
            'name'       => 'Faten Admin',
            'email'      => 'faten@csft.tn',
            'password'   => Hash::make('admin1234'),
            'role'       => 'admin', // Assurez-vous d'avoir ajouté la colonne 'role'
            'matricule'  => 'ADMIN-001',
            'is_active'  => true,
            'group_id'   => null,
        ]);

        User::create([
            'name'       => 'Fahmi Technique',
            'email'      => 'fahmi@csft.tn',
            'password'   => Hash::make('admin1234'),
            'role'       => 'admin',
            'matricule'  => 'ADMIN-002',
            'is_active'  => true,
            'group_id'   => null,
        ]);

        // ─────────────────────────────────────────────
        // FORMATEURS
        // ─────────────────────────────────────────────
        $formateurs = [
            ['name' => 'El Jeni Hejer',       'email' => 'h.eljeni@csft.tn',     'matricule' => 'FOR-001'],
            ['name' => 'Oueslati Brahim',      'email' => 'b.oueslati@csft.tn',   'matricule' => 'FOR-002'],
            ['name' => 'Kouki Imene',          'email' => 'i.kouki@csft.tn',      'matricule' => 'FOR-003'],
            ['name' => 'Ben Aicha Md Amen',    'email' => 'ma.benaicha@csft.tn',  'matricule' => 'FOR-004'],
            ['name' => 'Slama Ameni',          'email' => 'a.slama@csft.tn',      'matricule' => 'FOR-005'],
            ['name' => 'Ayedi Sami',           'email' => 's.ayedi@csft.tn',      'matricule' => 'FOR-006'],
        ];

        foreach ($formateurs as $formateur) {
            User::create([
                'name'       => $formateur['name'],
                'email'      => $formateur['email'],
                'password'   => Hash::make('formateur1234'),
                'role'       => 'teacher',
                'matricule'  => $formateur['matricule'],
                'is_active'  => true,
                'group_id'   => null, // Les formateurs n'ont pas de groupe assigné directement ici
            ]);
        }

        // ─────────────────────────────────────────────
        // STAGIAIRES (Liés à l'ID du groupe au lieu d'un texte)
        // ─────────────────────────────────────────────
        $stagiaires = [
            ['name' => 'Ahmed Ben Salem',      'email' => 'a.bensalem@csft.tn',   'matricule' => 'BTS125-01'],
            ['name' => 'Mariem Trabelsi',      'email' => 'm.trabelsi@csft.tn',   'matricule' => 'BTS125-02'],
            ['name' => 'Youssef Hammami',      'email' => 'y.hammami@csft.tn',    'matricule' => 'BTS125-03'],
            ['name' => 'Sana Gharbi',          'email' => 's.gharbi@csft.tn',     'matricule' => 'BTS125-04'],
            ['name' => 'Khalil Mansouri',      'email' => 'k.mansouri@csft.tn',   'matricule' => 'BTS125-05'],
            ['name' => 'Rania Jebali',         'email' => 'r.jebali@csft.tn',     'matricule' => 'BTS125-06'],
            ['name' => 'Omar Bouazizi',        'email' => 'o.bouazizi@csft.tn',   'matricule' => 'BTS125-07'],
            ['name' => 'Nour El Karray',       'email' => 'n.elkarray@csft.tn',   'matricule' => 'BTS125-08'],
        ];

        foreach ($stagiaires as $stagiaire) {
            User::create([
                'name'       => $stagiaire['name'],
                'email'      => $stagiaire['email'],
                'password'   => Hash::make('stagiaire1234'),
                'role'       => 'student',
                'matricule'  => $stagiaire['matricule'],
                'is_active'  => true,
                'group_id'   => $groupId, // Utilisation de la clé étrangère propre !
            ]);
        }
    }
}
