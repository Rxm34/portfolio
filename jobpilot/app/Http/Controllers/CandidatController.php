<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Offre;
use Illuminate\Support\Facades\Log;

class CandidatController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isEntreprise()) {
            $candidats = Candidat::whereHas('offres', function ($query) use ($user) {
                $query->where('entreprise_id', $user->entreprise_id);
            })->get();
        } else {
            $candidats = Candidat::all();
        }

        return view('candidats.index', compact('candidats'));
    }

    public function show(Candidat $candidat)
    {
        $user = auth()->user();
        if ($user->isCandidat() && $candidat->id !== $user->id) {
            abort(403, 'Accès refusé');
        }

        return view('candidats.show', compact('candidat'));
    }

    public function store(Request $request)
    {
        // Vérifie que c'est une candidature
        if ($request->filled('candidat_id') && $request->filled('offre_id')) {
            $candidat = Candidat::findOrFail($request->candidat_id);
            $offre = Offre::findOrFail($request->offre_id);

            if ($candidat->mail !== auth()->user()->email) {
                abort(403, 'Vous ne pouvez postuler qu’avec votre propre profil.');
            }

            // Vérifie si le candidat a déjà postulé
            $dejaPostule = $offre->candidats()->where('candidat_id', $candidat->id)->exists();

            if (!$dejaPostule) {
                $offre->candidats()->attach($candidat->id);
            }

            // Log systématique
            Log::channel('jobpilot')->info('Candidature créée', [
                'candidat_id' => $candidat->id,
                'nom' => $candidat->nom,
                'prenom' => $candidat->prenom,
                'date_naissance' => $candidat->date_naissance?->format('Y-m-d'),
                'mail' => $candidat->mail,
                'telephone' => $candidat->telephone,
                'adresse' => $candidat->adresse,
                'ville' => $candidat->ville,
                'offre_id' => $offre->id,
                'offre_titre' => $offre->titre,
                'user' => auth()->user()?->name,
            ]);

            return redirect()->route('offres.show', $offre->id)
                             ->with('success', 'Votre candidature a bien été envoyée !');
        }

        // Sinon création normale d'un candidat (admin)
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'mail' => 'required|email|unique:candidats,mail',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ]);

        $candidat = Candidat::create($validated);

        return redirect()->route('candidats.index')
                        ->with('success', 'Candidat créé avec succès.');
    }

    public function edit(Candidat $candidat)
    {
        $user = auth()->user();
        if ($user->isCandidat() && $candidat->id !== $user->id) {
            abort(403, 'Accès refusé');
        }

        return view('candidats.edit', compact('candidat'));
    }

    public function update(Request $request, Candidat $candidat)
    {
        $user = auth()->user();
        if ($user->isCandidat() && $candidat->id !== $user->id) {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'mail' => 'required|email|unique:candidats,mail,' . $candidat->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ]);

        $candidat->update($request->all());

        return redirect()->route('candidats.show', $candidat->id)
                         ->with('success', 'Profil mis à jour avec succès.');
    }

    public function destroy(Request $request, Candidat $candidat)
    {
        $user = auth()->user();

        // Suppression d'une candidature
        if ($request->filled('offre_id')) {
            $offre = Offre::findOrFail($request->offre_id);
            $offre->candidats()->detach($candidat->id);

            // Log de la suppression de candidature
            Log::channel('jobpilot')->info('Candidature supprimée', [
                'candidat_id' => $candidat->id,
                'nom' => $candidat->nom,
                'prenom' => $candidat->prenom,
                'date_naissance' => $candidat->date_naissance?->format('Y-m-d'),
                'mail' => $candidat->mail,
                'telephone' => $candidat->telephone,
                'adresse' => $candidat->adresse,
                'ville' => $candidat->ville,
                'offre_id' => $offre->id,
                'offre_titre' => $offre->titre,
                'user' => auth()->user()?->name,
            ]);

            if ($user->role === 'candidat' && $user->id === $candidat->user_id) {
                return redirect()->route('dashboard')
                                ->with('success', 'Votre candidature a été retirée avec succès.');
            }

            return redirect()->route('offres.show', $offre->id)
                            ->with('success', 'Le candidat a été retiré de l’offre.');
        }

        // Suppression du candidat (admin)
        $candidat->delete();

        return redirect()->route('candidats.index')
                        ->with('success', 'Candidat supprimé avec succès.');
    }
}
