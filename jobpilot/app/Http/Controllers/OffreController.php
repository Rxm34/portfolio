<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use App\Models\Entreprise;
use App\Models\Candidat;

class OffreController extends Controller
{
    // Liste de toutes les offres
    public function index()
    {
        $user = auth()->user();
        $offres = $user->role === 'entreprise'
            ? Offre::where('entreprise_id', $user->entreprise_id)->get()
            : Offre::all();

        return view('offres.index', compact('offres'));
    }

    public function create()
    {
        $user = auth()->user();
        $types_contrat = ['CDI','CDD','Stage','Alternance','Freelance'];
        $entreprises = $user->role === 'entreprise' ? [$user->entreprise] : Entreprise::all();

        return view('offres.create', compact('entreprises','types_contrat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'=>'required|string|max:255',
            'entreprise_id'=>'required|exists:entreprises,id',
            'lieu'=>'required|string|max:255',
            'date_publication'=>'required|date',
            'type_contrat_select'=>'required|string',
            'salaire'=>'required|numeric|min:0',
            'description'=>'required|string',
        ]);

        $offre = Offre::create([
            'titre'=>$validated['titre'],
            'entreprise_id'=>$validated['entreprise_id'],
            'lieu'=>$validated['lieu'],
            'date_publication'=>$validated['date_publication'],
            'type_contrat'=>$validated['type_contrat_select'],
            'salaire'=>$validated['salaire'],
            'description'=>$validated['description'],
        ]);

        return redirect()->route('offres.index')
                         ->with('success','Offre créée avec succès.');
    }

    public function show(Offre $offre)
    {
        $offre->load('entreprise', 'candidats'); // charge toujours les candidats depuis la BDD
        $autresOffres = $offre->entreprise->offres()->where('id', '!=', $offre->id)->get();

        $user = auth()->user();
        $candidatConnecte = null;
        $candidats = collect();

        if ($user->role === 'candidat') {
            $candidatConnecte = Candidat::where('mail', $user->email)->first();
            if (!$candidatConnecte) {
                return redirect()->route('candidats.create')
                    ->with('error', 'Veuillez compléter votre profil avant de postuler.');
            }

            if (empty($candidatConnecte->prenom) || empty($candidatConnecte->telephone) || empty($candidatConnecte->adresse)) {
                return redirect()->route('candidats.edit', $candidatConnecte->id)
                    ->with('error', 'Veuillez compléter votre profil avant de postuler.');
            }
        } else {
            $candidats = Candidat::whereDoesntHave('offres', function ($query) use ($offre) {
                $query->where('offre_id', $offre->id);
            })->get();
        }

        return view('offres.show', compact('offre', 'autresOffres', 'candidatConnecte', 'candidats'));
    }


    // Formulaire édition d'une offre
    public function edit(Offre $offre)
    {
        $user = auth()->user();
        if ($user->role === 'entreprise' && $offre->entreprise_id !== $user->entreprise->id) {
            abort(403, 'Accès refusé : cette offre ne vous appartient pas.');
        }
        if (!in_array($user->role, ['admin', 'entreprise'])) {
            abort(403, 'Accès refusé');
        }

        $entreprises = Entreprise::all();
        return view('offres.edit', compact('offre', 'entreprises'));
    }

    // Mise à jour d'une offre
    public function update(Request $request, Offre $offre)
    {
        $user = auth()->user();
        if ($user->role === 'entreprise' && $offre->entreprise_id !== $user->entreprise->id) {
            abort(403, 'Accès refusé : cette offre ne vous appartient pas.');
        }
        if (!in_array($user->role, ['admin', 'entreprise'])) {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date_publication' => 'required|date',
            'salaire' => 'required|numeric',
            'description' => 'required|string',
            'entreprise_id' => 'required|exists:entreprises,id',
            'type_contrat' => 'required|in:CDI,CDD,Stage,Alternance,Freelance',
        ]);

        $offre->update($request->all());

        return redirect()->route('offres.show', $offre->id)
            ->with('success', 'Offre modifiée avec succès.');
    }

    // Suppression d'une offre
    public function destroy(Offre $offre)
    {
        $user = auth()->user();
        if ($user->role === 'entreprise' && $offre->entreprise_id !== $user->entreprise->id) {
            abort(403, 'Accès refusé : cette offre ne vous appartient pas.');
        }
        if (!in_array($user->role, ['admin', 'entreprise'])) {
            abort(403, 'Accès refusé');
        }

        $offre->delete();

        return redirect()->route('offres.index')
            ->with('success', 'Offre supprimée avec succès.');
    }
}
