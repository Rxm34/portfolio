<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Offre;
use App\Models\Entreprise;
use App\Models\Candidat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // -------------------------
        // STATISTIQUES ADMIN
        // -------------------------
        $totalOffres = Offre::count();
        $totalEntreprises = Entreprise::count();
        $totalCandidats = Candidat::count();
        $lastOffre = Offre::latest()->first();
        $lastEntreprise = Entreprise::latest()->first();
        $lastCandidat = Candidat::latest()->first();
        $users = User::orderBy('name')->get();

        // -------------------------
        // VARIABLES PAR DÉFAUT
        // -------------------------
        $offres = collect();
        $offresCount = 0;
        $candidaturesCount = 0;
        $candidaturesEnvoyees = 0;
        $candidatConnecte = null; // ✅ Nouvelle variable

        // -------------------------
        // ROLE ENTREPRISE
        // -------------------------
        if ($role === 'entreprise' && $user->entreprise_id) {
            $offres = Offre::with('candidats')
                ->where('entreprise_id', $user->entreprise_id)
                ->get()
                ->map(function ($offre) {
                    $offre->candidats_count = $offre->candidats->count();
                    return $offre;
                });

            $offresCount = $offres->count();
            $candidaturesCount = $offres->sum(fn($offre) => $offre->candidats_count);
        }

        // -------------------------
        // ROLE CANDIDAT
        // -------------------------
        if ($role === 'candidat') {
            // ✅ Récupération du candidat connecté
            $candidatConnecte = Candidat::where('mail', $user->email)->first();

            if ($candidatConnecte) {
                $offres = $candidatConnecte->offres()->with('entreprise')->get();
                $candidaturesEnvoyees = $offres->count();
            }
        }

        // -------------------------
        // RETOURNE LA VUE
        // -------------------------
        return view('dashboard', compact(
            'role',
            'totalOffres',
            'totalEntreprises',
            'totalCandidats',
            'lastOffre',
            'lastEntreprise',
            'lastCandidat',
            'users',
            'offres',
            'offresCount',
            'candidaturesCount',
            'candidaturesEnvoyees',
            'candidatConnecte' // ✅ On envoie à la vue
        ));
    }

    // -------------------------
    // AUTRES MÉTHODES
    // -------------------------
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|in:admin,entreprise,candidat',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Rôle mis à jour avec succès.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function deleteOffre($id)
    {
        $user = Auth::user();
        $offre = Offre::findOrFail($id);

        if ($user->role === 'admin' || ($user->role === 'entreprise' && $offre->entreprise_id === $user->entreprise_id)) {
            $offre->delete();
            return redirect()->route('dashboard')->with('success', 'Offre supprimée avec succès.');
        }

        abort(403, 'Accès interdit.');
    }
}
