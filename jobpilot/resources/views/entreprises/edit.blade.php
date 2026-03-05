@extends('layouts.app')

@section('content')
<div class="container-show">
    <div class="card">
        <h1 class="h1-show" style="margin-top:-4px;">Modifier l'entreprise</h1>

        <form action="{{ route('entreprises.update', $entreprise) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $entreprise->nom) }}" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" required>{{ old('description', $entreprise->description) }}</textarea>

            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" value="{{ old('mail', $entreprise->mail)}}" required>

            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $entreprise->telephone) }}" required>

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $entreprise->adresse) }}" required> 

            <div style="margin-top:25px; display:flex; gap:12px; justify-content:flex-end;">
                <button type="submit" 
                        style="background-color:#4caf50; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    Mettre à jour
                </button>
                <button type="button"
                        onclick="window.location='{{ route('entreprises.index') }}'"
                        style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
