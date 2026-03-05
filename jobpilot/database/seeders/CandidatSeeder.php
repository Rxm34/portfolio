<?php

namespace Database\Seeders;

use App\Models\Candidat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidat::insert([
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'date_naissance' => '1990-03-15',
                'mail' => 'jean.dupont@example.com',
                'telephone' => '06 00 00 00 01',
                'adresse' => '10 rue de Paris',
                'ville' => 'Paris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'date_naissance' => '1992-07-22',
                'mail' => 'sophie.martin@example.com',
                'telephone' => '06 00 00 00 02',
                'adresse' => '25 avenue de Lyon',
                'ville' => 'Lyon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Durand',
                'prenom' => 'Luc',
                'date_naissance' => '1988-11-05',
                'mail' => 'luc.durand@example.com',
                'telephone' => '06 00 00 00 03',
                'adresse' => '5 boulevard de Marseille',
                'ville' => 'Marseille',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Claire',
                'date_naissance' => '1995-01-30',
                'mail' => 'claire.bernard@example.com',
                'telephone' => '06 00 00 00 04',
                'adresse' => '12 rue Bordeaux',
                'ville' => 'Bordeaux',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Lefevre',
                'prenom' => 'Paul',
                'date_naissance' => '1991-09-10',
                'mail' => 'paul.lefevre@example.com',
                'telephone' => '06 00 00 00 05',
                'adresse' => '8 avenue Nantes',
                'ville' => 'Nantes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
