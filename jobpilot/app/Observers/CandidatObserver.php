<?php

namespace App\Observers;

use App\Models\Candidat;
use Illuminate\Support\Facades\Log;

class CandidatObserver
{
    public function created(Candidat $candidat)
    {
        $data = [
            'candidat_id' => $candidat->id,
            'nom' => $candidat->nom,
            'prenom' => $candidat->prenom,
            'date_naissance' => $candidat->date_naissance,
            'mail' => $candidat->mail,
            'telephone' => $candidat->telephone,
            'adresse' => $candidat->adresse,
            'ville' => $candidat->ville,
            'user' => auth()->user()?->name,
            'candidatures' => $candidat->offres->map(function($offre) {
                return [
                    'offre_id' => $offre->id,
                    'titre' => $offre->titre,
                ];
            })->toArray(),
        ];

        Log::channel('jobpilot')->info('Candidat créé', $data);
    }

    public function updated(Candidat $candidat)
    {
        $old = $candidat->getOriginal();
        $new = $candidat->getAttributes();

        $data = [
            'candidat_id' => $candidat->id,
            'user' => auth()->user()?->name,
            'old' => [
                'nom' => $old['nom'] ?? null,
                'prenom' => $old['prenom'] ?? null,
                'date_naissance' => $old['date_naissance'] ?? null,
                'mail' => $old['mail'] ?? null,
                'telephone' => $old['telephone'] ?? null,
                'adresse' => $old['adresse'] ?? null,
                'ville' => $old['ville'] ?? null,
            ],
            'new' => [
                'nom' => $new['nom'] ?? null,
                'prenom' => $new['prenom'] ?? null,
                'date_naissance' => $new['date_naissance'] ?? null,
                'mail' => $new['mail'] ?? null,
                'telephone' => $new['telephone'] ?? null,
                'adresse' => $new['adresse'] ?? null,
                'ville' => $new['ville'] ?? null,
            ],
        ];

        Log::channel('jobpilot')->info('Candidat mis à jour', $data);
    }

    public function deleted(Candidat $candidat)
    {
        $data = [
            'candidat_id' => $candidat->id,
            'nom' => $candidat->nom,
            'prenom' => $candidat->prenom,
            'mail' => $candidat->mail,
            'user' => auth()->user()?->name,
            'candidatures' => $candidat->offres->map(function($offre) {
                return [
                    'offre_id' => $offre->id,
                    'titre' => $offre->titre,
                ];
            })->toArray(),
        ];

        Log::channel('jobpilot')->info('Candidat supprimé', $data);
    }
}
