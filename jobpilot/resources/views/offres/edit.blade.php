@extends('layouts.app')

@section('content')
<div class="container-show">
    <div class="card" style="max-width:700px; margin:auto; padding:35px;">
        <h1 class="h1-show" style="margin-top:-4px;">Modifier l'offre</h1>

        <form action="{{ route('offres.update', $offre) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $offre->titre) }}" required>

            <label for="entreprise_id">Entreprise</label>
            <select name="entreprise_id" id="entreprise_id" required>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}" {{ $offre->entreprise_id == $entreprise->id ? 'selected' : '' }}>
                        {{ $entreprise->nom }}
                    </option>
                @endforeach
            </select>

            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" id="lieu" value="{{ old('lieu', $offre->lieu) }}" required>

            <label for="date_publication">Date de publication</label>
            <input type="date" name="date_publication" id="date_publication" value="{{ old('date_publication', $offre->date_publication->format('Y-m-d')) }}" required>

            <label for="type_contrat">Type de contrat</label>
            <select name="type_contrat" id="type_contrat" required>
                @foreach(['CDI','CDD','Stage','Alternance'] as $type)
                    <option value="{{ $type }}" {{ $offre->type_contrat == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <label for="salaire">Salaire</label>
            <input type="number" step="0.01" name="salaire" id="salaire" value="{{ old('salaire', $offre->salaire) }}" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" required>{{ old('description', $offre->description) }}</textarea>

            <div style="margin-top:25px; display:flex; gap:12px; justify-content:flex-end;">
                <button type="submit" 
                        style="background-color:#4caf50; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    Mettre à jour
                </button>
                <button type="button"
                        onclick="window.location='{{ route('offres.index') }}'"
                        style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
