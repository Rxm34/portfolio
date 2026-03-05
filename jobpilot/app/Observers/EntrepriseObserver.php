<?php

namespace App\Observers;

use App\Models\Entreprise;
use Illuminate\Support\Facades\Log;

class EntrepriseObserver
{
    public function created(Entreprise $entreprise)
    {
        $data = [
            'entreprise_id' => $entreprise->id,
            'nom' => $entreprise->nom,
            'description' => $entreprise->description,
            'mail' => $entreprise->mail,
            'telephone' => $entreprise->telephone,
            'adresse' => $entreprise->adresse,
            'user' => auth()->user()?->name,
        ];

        Log::channel('jobpilot')->info('Entreprise créée', $data);
    }

    public function updated(Entreprise $entreprise)
    {
        $old = $entreprise->getOriginal();
        $new = $entreprise->getAttributes();

        $data = [
            'entreprise_id' => $entreprise->id,
            'user' => auth()->user()?->name,
            'old' => [
                'nom' => $old['nom'] ?? null,
                'description' => $old['description'] ?? null,
                'mail' => $old['mail'] ?? null,
                'telephone' => $old['telephone'] ?? null,
                'adresse' => $old['adresse'] ?? null,
            ],
            'new' => [
                'nom' => $new['nom'] ?? null,
                'description' => $new['description'] ?? null,
                'mail' => $new['mail'] ?? null,
                'telephone' => $new['telephone'] ?? null,
                'adresse' => $new['adresse'] ?? null,
            ],
        ];

        Log::channel('jobpilot')->info('Entreprise mise à jour', $data);
    }

    public function deleted(Entreprise $entreprise)
    {
        $data = [
            'entreprise_id' => $entreprise->id,
            'nom' => $entreprise->nom,
            'mail' => $entreprise->mail,
            'user' => auth()->user()?->name,
        ];

        Log::channel('jobpilot')->info('Entreprise supprimée', $data);
    }
}
