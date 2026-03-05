<?php

namespace App\Observers;

use App\Models\Offre;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Log;

class OffreObserver
{
    /**
     * Log lors de la création d'une offre
     */
    public function created(Offre $offre)
    {
        $data = [
            'offre_id' => $offre->id,
            'titre' => $offre->titre,
            'lieu' => $offre->lieu,
            'date_publication' => $offre->date_publication,
            'type_contrat' => $offre->type_contrat,
            'salaire' => $offre->salaire,
            'description' => $offre->description,
            'entreprise_id' => $offre->entreprise_id,
            'entreprise_nom' => $offre->entreprise->nom ?? null,
            'user' => auth()->user()?->name
        ];

        Log::channel('jobpilot')->info('Offre créée', $data);
    }

    /**
     * Log lors de la mise à jour d'une offre
     * avec avant / après pour tous les champs
     */
    public function updated(Offre $offre)
    {
        $old = $offre->getOriginal();
        $new = $offre->getAttributes();

        $oldEntrepriseNom = Entreprise::find($offre->getOriginal('entreprise_id'))?->nom;
        $newEntrepriseNom = $offre->entreprise?->nom;

        $data = [
            'offre_id' => $offre->id,
            'user' => auth()->user()?->name,
            'old' => [
                'titre' => $old['titre'] ?? null,
                'entreprise_nom' => $oldEntrepriseNom,
                'lieu' => $old['lieu'] ?? null,
                'date_publication' => $old['date_publication'] ?? null,
                'type_contrat' => $old['type_contrat'] ?? null,
                'salaire' => $old['salaire'] ?? null,
                'description' => $old['description'] ?? null,
                'entreprise_id' => $old['entreprise_id'] ?? null,
            ],
            'new' => [
                'titre' => $new['titre'] ?? null,
                'entreprise_nom' => $newEntrepriseNom,
                'lieu' => $new['lieu'] ?? null,
                'date_publication' => $new['date_publication'] ?? null,
                'type_contrat' => $new['type_contrat'] ?? null,
                'salaire' => $new['salaire'] ?? null,
                'description' => $new['description'] ?? null,
                'entreprise_id' => $new['entreprise_id'] ?? null,
            ],
        ];
        
        Log::channel('jobpilot')->info('Offre mise à jour', $data);
    }

    /**
     * Log lors de la suppression d'une offre
     */
    public function deleted(Offre $offre)
    {
        $data = [
            'offre_id' => $offre->id,
            'titre' => $offre->titre,
            'lieu' => $offre->lieu,
            'date_publication' => $offre->date_publication,
            'type_contrat' => $offre->type_contrat,
            'salaire' => $offre->salaire,
            'description' => $offre->description,
            'entreprise_id' => $offre->entreprise_id,
            'entreprise_nom' => $offre->entreprise->nom ?? null,
            'user' => auth()->user()?->name,
        ];

        Log::channel('jobpilot')->info('Offre supprimée', $data);
    }
}
