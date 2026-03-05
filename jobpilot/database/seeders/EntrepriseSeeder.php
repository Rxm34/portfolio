<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entreprise::insert([
            [
                'nom' => 'TechCompany',
                'description' => 'Entreprise spécialisée en technologies.',
                'mail' => 'contact@techcompany.com',
                'telephone' => '01 02 03 04 05',
                'adresse' => '10 rue de la Technologie, Paris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'CreativeStudio',
                'description' => 'Studio créatif spécialisé en design.',
                'mail' => 'contact@creativestudio.com',
                'telephone' => '02 03 04 05 06',
                'adresse' => '25 avenue de la Création, Lyon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'ManagementPro',
                'description' => 'Société de gestion et consulting.',
                'mail' => 'contact@managementpro.com',
                'telephone' => '03 04 05 06 07',
                'adresse' => '15 boulevard du Management, Marseille',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'SocialMediaInc',
                'description' => 'Agence de marketing digital.',
                'mail' => 'contact@socialmediainc.com',
                'telephone' => '04 05 06 07 08',
                'adresse' => '50 rue du Marketing, Bordeaux',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'WebDevCo',
                'description' => 'Entreprise spécialisée en développement web.',
                'mail' => 'contact@webdevco.com',
                'telephone' => '05 06 07 08 09',
                'adresse' => '100 avenue du Web, Nantes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
