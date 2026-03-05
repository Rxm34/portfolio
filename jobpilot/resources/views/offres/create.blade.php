@extends('layouts.app')

@section('content')
<div class="container-show">
    <div class="card">
        <h1 class="h1-show" style="margin-top:-4px;">Ajouter une nouvelle offre</h1>

        @if(session('success'))
            <div style="background-color:#4caf50; color:#fff; padding:12px 18px; border-radius:6px; text-align:center; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color:#f44336; color:#fff; padding:12px 18px; border-radius:6px; margin-bottom:20px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('offres.store') }}" method="POST">
            @csrf

            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" placeholder="Ex : Développeur web ..." required>

            <label for="entreprise_id">Entreprise</label>

            @if(auth()->user()->role === 'entreprise')
                {{-- Si l'utilisateur est une entreprise, afficher son nom sans choix possible --}}
                <input type="hidden" name="entreprise_id" value="{{ $entreprises[0]->id }}">
                <input type="text" value="{{ $entreprises[0]->nom }}" disabled>
            @else
                {{-- Sinon (admin), afficher la liste déroulante --}}
                <select name="entreprise_id" id="entreprise_id" required>
                    <option value="">Choisir une entreprise</option>
                    @foreach($entreprises as $entreprise)
                        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                    @endforeach
                </select>
            @endif


            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" id="lieu" placeholder="Ex : Paris, Lyon, Marseille ..." required>

            <label for="date_publication">Date de publication</label>
            <input type="date" name="date_publication" id="date_publication" required>

            <label for="type_contrat">Type de contrat</label>
            <select name="type_contrat_select" id="type_contrat_select" required>
                <option value="">Choisir un type de contrat</option>
                @foreach($types_contrat as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>

            <label for="salaire">Salaire (€)</label>
            <input type="number" step="0.01" name="salaire" id="salaire" placeholder="Ex : 2500 ..." required>

            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Décrivez le poste, les missions, le profil recherché..." required></textarea>

            <div style="margin-top:25px; display:flex; gap:12px; justify-content:flex-end;">
                <button type="submit" 
                        style="background-color:#4CAF50; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    <i class="fas fa-check"></i> Créer l’offre
                </button>

                <button type="button"
                        onclick="window.location='{{ route('offres.index') }}'"
                        style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    <i class="fas fa-arrow-left"></i> Annuler
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
