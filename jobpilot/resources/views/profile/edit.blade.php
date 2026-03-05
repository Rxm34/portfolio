@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Formulaire Profil adapté au rôle -->
        <div class="p-6 bg-[#1b1b1b] shadow sm:rounded-lg">
            <h1 class="text-center text-white text-2xl font-semibold mb-6">Profil</h1>
            <div class="max-w-xl mx-auto">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <!-- Nom -->
                    <div class="info">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" 
                               value="{{ old('nom', 
                                    $user->role === 'entreprise' ? ($entreprise->nom ?? $user->name) : 
                                    ($user->role === 'candidat' ? ($candidat->nom ?? $user->name) : $user->name)
                               ) }}" required>
                        @error('nom')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role-specific fields -->
                    @if($user->role === 'admin')
                        <div class="info">
                            <label for="mail">Email</label>
                            <input type="email" name="mail" id="mail" value="{{ old('mail', $user->email) }}" required>
                        </div>
                        <div class="info">
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}">
                        </div>
                        <div class="info">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $user->adresse) }}">
                        </div>
                        <div class="info">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" value="{{ old('ville', $user->ville) }}">
                        </div>

                    @elseif($user->role === 'entreprise')
                        <div class="info">
                            <label for="mail">Email</label>
                            <input type="email" name="mail" id="mail" 
                                   value="{{ old('mail', $entreprise->mail ?? $user->email) }}" required>
                        </div>

                        <div class="info">
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" 
                                   value="{{ old('telephone', $entreprise->telephone ?? $user->telephone ?? '') }}">
                        </div>

                        <div class="info">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" 
                                   value="{{ old('adresse', $entreprise->adresse ?? $user->adresse ?? '') }}">
                        </div>

                        <div class="info">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" 
                                   value="{{ old('ville', $user->ville ?? '') }}">
                        </div>

                        <div class="info">
                            <label for="description">Description</label>
                            <textarea name="description" id="description">{{ old('description', $entreprise->description ?? '') }}</textarea>
                        </div>

                    @elseif($user->role === 'candidat')
                        <div class="info">
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $candidat->prenom ?? '') }}" required>
                        </div>
                        <div class="info">
                            <label for="mail">Email</label>
                            <input type="email" name="mail" id="mail" 
                                   value="{{ old('mail', $candidat->mail ?? $user->email) }}" required>
                        </div>
                        <div class="info">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" 
                                   value="{{ old('date_naissance', isset($candidat->date_naissance) ? $candidat->date_naissance->format('Y-m-d') : '') }}">
                        </div>
                        <div class="info">
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $candidat->telephone ?? '') }}">
                        </div>
                        <div class="info">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $candidat->adresse ?? '') }}">
                        </div>
                        <div class="info">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" value="{{ old('ville', $candidat->ville ?? '') }}">
                        </div>
                    @endif

                    <div class="text-center mt-6">
                        <button type="submit" class="btn-create">Mettre à jour le profil</button>
                    </div>

                    @if (session('status') === 'profile-updated')
                        <div class="success-message mt-4 text-center">Profil mis à jour !</div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Changement de mot de passe -->
        <div class="p-6 bg-[#1b1b1b] shadow sm:rounded-lg">
            <h2 class="text-center text-white text-2xl font-semibold mb-6">Changer le mot de passe</h2>
            <div class="max-w-xl mx-auto">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="info">
                        <label for="current_password">Mot de passe actuel</label>
                        <input type="password" name="current_password" id="current_password" required>
                        @error('current_password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="info">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" required>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="info">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-create">Mettre à jour le mot de passe</button>
                    </div>

                    @if (session('password-updated'))
                        <div class="success-message mt-4 text-center">Mot de passe mis à jour avec succès !</div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Suppression du compte -->
        <div class="p-6 bg-[#1b1b1b] shadow sm:rounded-lg">
            <h2 class="text-center text-white text-2xl font-semibold mb-6">Supprimer le compte</h2>
            <div class="max-w-xl mx-auto text-center">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-create" style="background-color:#f44336; border-color:#f44336;">
                        Supprimer mon compte
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
