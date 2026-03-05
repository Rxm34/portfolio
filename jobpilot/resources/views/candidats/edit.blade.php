@extends('layouts.app')

@section('content')
<div class="container-show">
    <div class="card">
        <h1 class="h1-show" style="margin-top:-4px;">Modifier le candidat</h1>

        <form action="{{ route('candidats.update', $candidat) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $candidat->nom) }}" required>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $candidat->prenom) }}" required>

            <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $candidat->date_naissance?->format('Y-m-d')) }}" required>

            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" value="{{ old('mail', $candidat->mail) }}" required>

            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $candidat->telephone) }}" required> 

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $candidat->adresse) }}" required> 

            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" value="{{ old('ville', $candidat->ville) }}" required> 

            <div style="margin-top:25px; display:flex; gap:12px; justify-content:flex-end;">
                <button type="submit" 
                        style="background-color:#4caf50; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    Mettre à jour
                </button>
                <button type="button"
                        onclick="window.location='{{ route('candidats.index') }}'"
                        style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
