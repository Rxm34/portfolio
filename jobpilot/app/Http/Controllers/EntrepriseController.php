<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Offre;

class EntrepriseController extends Controller
{
    // Liste toutes les entreprises
    public function index()
    {
        // admin, entreprise et candidat peuvent accéder
        if (!in_array(auth()->user()->role, ['admin', 'entreprise', 'candidat'])) {
            abort(403, 'Accès refusé');
        }

        $entreprises = Entreprise::all();
        return view('entreprises.index', compact('entreprises'));
    }

    // Formulaire de création (admin uniquement)
    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Accès réservé à l’administrateur.');
        }

        return view('entreprises.create');
    }

    // Stocke une nouvelle entreprise (admin uniquement)
    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Accès réservé à l’administrateur.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'mail' => 'required|email|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        Entreprise::create($request->all());

        return redirect()->route('entreprises.index')->with('success', 'Entreprise ajoutée avec succès.');
    }

    // Affiche une entreprise et ses offres
    public function show(Entreprise $entreprise)
    {
        // admin, entreprise et candidat peuvent accéder
        if (!in_array(auth()->user()->role, ['admin', 'entreprise', 'candidat'])) {
            abort(403, 'Accès refusé');
        }

        $offres = Offre::where('entreprise_id', $entreprise->id)->get();

        return view('entreprises.show', compact('entreprise', 'offres'));
    }

    // Formulaire d'édition (admin ou entreprise propriétaire)
    public function edit(Entreprise $entreprise)
    {
        if (auth()->user()->role === 'entreprise' && auth()->user()->entreprise->id !== $entreprise->id) {
            abort(403, 'Accès refusé : cette entreprise ne vous appartient pas.');
        }

        if (!in_array(auth()->user()->role, ['admin', 'entreprise'])) {
            abort(403, 'Accès refusé');
        }

        return view('entreprises.edit', compact('entreprise'));
    }

    // Met à jour une entreprise (admin ou entreprise propriétaire)
    public function update(Request $request, Entreprise $entreprise)
    {
        if (auth()->user()->role === 'entreprise' && auth()->user()->entreprise->id !== $entreprise->id) {
            abort(403, 'Accès refusé : cette entreprise ne vous appartient pas.');
        }

        if (!in_array(auth()->user()->role, ['admin', 'entreprise'])) {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'mail' => 'required|email|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        $entreprise->update($request->all());

        return redirect()->route('entreprises.show', $entreprise->id)->with('success', 'Entreprise mise à jour avec succès.');
    }

    // Supprime une entreprise (admin uniquement)
    public function destroy(Entreprise $entreprise)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Seul l’administrateur peut supprimer une entreprise.');
        }

        $entreprise->delete();

        return redirect()->route('entreprises.index')->with('success', 'Entreprise supprimée avec succès.');
    }
}
