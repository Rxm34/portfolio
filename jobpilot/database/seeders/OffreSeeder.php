<?php

namespace Database\Seeders;

use App\Models\Offre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offre::insert([
                [
                    'titre' => 'Développeur Laravel',
                    'entreprise_id' => 1,
                    'lieu' => 'Paris',
                    'date_publication' => '2025-09-01',
                    'type_contrat' => 'CDI',
                    'salaire' => 3750,
                    'description' => 'Nous recherchons un développeur Laravel pour rejoindre notre équipe et travailler sur des projets innovants.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Designer UX/UI',
                    'entreprise_id' => 2,
                    'lieu' => 'Lyon',
                    'date_publication' => '2025-08-25',
                    'type_contrat' => 'CDD',
                    'salaire' => 2916,
                    'description' => 'Rejoignez notre équipe pour concevoir des interfaces utilisateur modernes et intuitives.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Chef de projet IT',
                    'entreprise_id' => 3,
                    'lieu' => 'Marseille',
                    'date_publication' => '2025-07-18',
                    'type_contrat' => 'CDI',
                    'salaire' => 4583,
                    'description' => 'Coordination de projets d’envergure dans le secteur des nouvelles technologies.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Community Manager',
                    'entreprise_id' => 4,
                    'lieu' => 'Bordeaux',
                    'date_publication' => '2025-07-10',
                    'type_contrat' => 'Stage',
                    'salaire' => 1200,
                    'description' => 'Gestion des réseaux sociaux et développement de la communauté autour de la marque.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Développeur Front-end',
                    'entreprise_id' => 5,
                    'lieu' => 'Nantes',
                    'date_publication' => '2025-06-15',
                    'type_contrat' => 'CDI',
                    'salaire' => 3333,
                    'description' => 'Développement d’applications web avec ReactJS.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Développeur Python',
                    'entreprise_id' => 1,
                    'lieu' => 'Toulouse',
                    'date_publication' => '2025-06-01',
                    'type_contrat' => 'Alternance',
                    'salaire' => 4000,
                    'description' => 'Développement d’algorithmes et d’applications de traitement de données en Python.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Chef de projet Digital',
                    'entreprise_id' => 2,
                    'lieu' => 'Paris',
                    'date_publication' => '2025-05-12',
                    'type_contrat' => 'CDI',
                    'salaire' => 4167,
                    'description' => 'Gestion des projets digitaux en équipe, supervision des deadlines et des budgets.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Consultant en stratégie',
                    'entreprise_id' => 3,
                    'lieu' => 'Lille',
                    'date_publication' => '2025-05-05',
                    'type_contrat' => 'CDI',
                    'salaire' => 5000,
                    'description' => 'Conseil stratégique auprès de grandes entreprises sur leurs projets de transformation digitale.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Responsable Marketing',
                    'entreprise_id' => 4,
                    'lieu' => 'Nice',
                    'date_publication' => '2025-04-20',
                    'type_contrat' => 'CDI',
                    'salaire' => 3750,
                    'description' => 'Gestion de l’équipe marketing et stratégie de communication pour la marque.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Data Scientist',
                    'entreprise_id' => 5,
                    'lieu' => 'Strasbourg',
                    'date_publication' => '2025-04-02',
                    'type_contrat' => 'CDI',
                    'salaire' => 4583,
                    'description' => 'Analyse de données massives pour créer des solutions innovantes.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
        ]);
    }
}