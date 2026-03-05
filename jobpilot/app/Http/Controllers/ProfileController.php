<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Candidat;

class ProfileController extends Controller
{
    /**
     * Affiche le formulaire d’édition du profil.
     */
    public function edit()
    {
        $user = Auth::user();

        if ($user->role === 'entreprise') {
            $entreprise = Entreprise::where('mail', $user->email)->first();
            return view('profile.edit', compact('user', 'entreprise'));
        } elseif ($user->role === 'candidat') {
            $candidat = Candidat::where('mail', $user->email)->first();
            return view('profile.edit', compact('user', 'candidat'));
        } else {
            return view('profile.edit', compact('user'));
        }
    }

    /**
     * Met à jour les informations du profil et/ou le mot de passe.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $passwordUpdated = false;

        // 🔹 Mise à jour du mot de passe si les champs sont remplis
        if ($request->filled('current_password') || $request->filled('password') || $request->filled('password_confirmation')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            $passwordUpdated = true;
        }

        // 🔹 Mise à jour du profil
        if ($request->filled('nom') || $request->filled('mail')) {

            if ($user->role === 'entreprise') {
                $entreprise = Entreprise::where('mail', $user->email)->first();

                $request->validate([
                    'nom' => 'required|string|max:255',
                    'description' => 'nullable|string|max:1000',
                    'mail' => 'required|email|max:255|unique:entreprises,mail,' . ($entreprise->id ?? 'NULL'),
                    'telephone' => 'nullable|string|max:20',
                    'adresse' => 'nullable|string|max:255',
                    'ville' => 'nullable|string|max:255',
                ]);

                if (!$entreprise) $entreprise = new Entreprise();

                // Mise à jour table ENTREPRISES
                $entreprise->nom = $request->nom;
                $entreprise->description = $request->description;
                $entreprise->mail = $request->mail;
                $entreprise->telephone = $request->telephone;
                $entreprise->adresse = $request->adresse;
                $entreprise->save();

                // Synchronisation table USERS
                $user->name = $request->nom;
                $user->email = $request->mail;
                $user->telephone = $request->telephone;
                $user->adresse = $request->adresse;
                $user->ville = $request->ville;
                $user->save();

            } elseif ($user->role === 'candidat') {
                $candidat = Candidat::where('mail', $user->email)->first();

                $request->validate([
                    'nom' => 'required|string|max:255',
                    'prenom' => 'required|string|max:255',
                    'date_naissance' => 'nullable|date',
                    'mail' => 'required|email|max:255|unique:candidats,mail,' . ($candidat->id ?? 'NULL'),
                    'telephone' => 'nullable|string|max:20',
                    'adresse' => 'nullable|string|max:255',
                    'ville' => 'nullable|string|max:255',
                ]);

                if (!$candidat) $candidat = new Candidat();

                // Mise à jour table CANDIDATS
                $candidat->nom = $request->nom;
                $candidat->prenom = $request->prenom;
                $candidat->date_naissance = $request->date_naissance;
                $candidat->mail = $request->mail;
                $candidat->telephone = $request->telephone;
                $candidat->adresse = $request->adresse;
                $candidat->ville = $request->ville;
                $candidat->save();

                // Synchronisation table USERS
                $user->name = $request->nom;
                $user->email = $request->mail;
                $user->telephone = $request->telephone;
                $user->adresse = $request->adresse;
                $user->ville = $request->ville;
                $user->save();

            } else { // Admin
                $request->validate([
                    'nom' => 'required|string|max:255',
                    'mail' => 'required|email|max:255|unique:users,email,' . $user->id,
                    'telephone' => 'nullable|string|max:20',
                    'adresse' => 'nullable|string|max:255',
                    'ville' => 'nullable|string|max:255',
                ]);

                $user->name = $request->nom;
                $user->email = $request->mail;
                $user->telephone = $request->telephone;
                $user->adresse = $request->adresse;
                $user->ville = $request->ville;
                $user->save();
            }
        }

        // 🔹 Redirection avec message approprié
        if ($passwordUpdated) {
            return redirect()->route('profile.edit')->with('password-updated', true);
        }

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Supprime le compte utilisateur et son profil associé.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if ($user->role === 'entreprise') {
            Entreprise::where('mail', $user->email)->delete();
        } elseif ($user->role === 'candidat') {
            Candidat::where('mail', $user->email)->delete();
        }

        $user->delete();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'account-deleted');
    }
}
