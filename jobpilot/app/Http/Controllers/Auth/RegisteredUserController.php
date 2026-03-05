<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'inscription
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:candidat,entreprise',
        ]);

        // Création utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'entreprise') {
            $entreprise = Entreprise::create([
                'nom' => $user->name,   // <-- le name du user devient le nom de l'entreprise
                'mail' => $user->email, // ou autre valeur si nécessaire
            ]);

            $user->entreprise_id = $entreprise->id;
            $user->save();
        }

        if ($request->role === 'candidat') {
            $candidat = Candidat::create([
                'nom' => $user->name,
                'mail' => $user->email,
                // tu peux ajouter d'autres champs par défaut ou null
            ]);
        }

        // 🔹 Redirige vers le formulaire de connexion
        return redirect()->route('login')->with('success', 'Votre compte a été créé. Veuillez vous connecter.');
    }
}
