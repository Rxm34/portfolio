@extends('layouts.app')

@section('content')
<div class="container-show">
    <div class="card" style="max-width:800px; margin:auto;">
        {{-- Message de succès --}}
        @if(session('success'))
            <div class="success-message" style="background-color:#4CAF50; color:#fff; padding:12px; border-radius:6px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Détails de l'offre --}}
        <h1 class="h1-show" style="margin-top:-4px;">{{ $offre->titre }}</h1>
        <p class="info" style="margin-top:50px;">
            <strong><i class="fas fa-building" style="color:#4caf50; margin-right:6px;"></i> Entreprise :</strong> 
            {{ $offre->entreprise->nom }}
        </p>
        <p class="info"><strong><i class="fas fa-map-marker-alt" style="color:#ff9800; margin-right:6px;"></i> Lieu :</strong> {{ $offre->lieu }}</p>
        <p class="info"><strong><i class="fas fa-calendar-alt" style="color:#9c27b0; margin-right:6px;"></i> Date :</strong> {{ $offre->date_publication->format('d/m/Y') }}</p>
        <p class="info">
            <strong><i class="fas fa-file-contract" style="color:#2196f3; margin-right:6px;"></i> Contrat :</strong> 
            <span class="badge badge-{{ strtolower($offre->type_contrat) }}">{{ $offre->type_contrat }}</span>
        </p>
        <p class="info"><strong><i class="fas fa-euro-sign" style="color:#e91e63; margin-right:6px;"></i> Salaire :</strong> {{ $offre->salaire }} €</p>
        <div class="description">
            <strong style="color:#00bcd4;"><i class="fas fa-align-left" style="margin-right:6px;"></i> Description :</strong><br>
            <p style="color:#ccc; margin-top:8px; line-height:1.6;">{{ $offre->description }}</p>
        </div>

        <div style="margin-top: 35px; text-align: right;">
            <button type="button" 
                    onclick="window.location='{{ route('offres.index') }}'" 
                    style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:8px; font-weight:bold; cursor:pointer;">
                <i class="fas fa-arrow-left"></i> Retour aux offres
            </button>
        </div>
    </div>
</div>

{{-- Autres offres de la même entreprise --}}
@if($autresOffres->count() > 0)
    <h2 class="h1-show" style="margin-top: 60px;">Autres offres de {{ $offre->entreprise->nom }}</h2>
    <div class="liste_offres">
        @foreach($autresOffres as $autreOffre)
            @include('components.OffreCard', ['offre' => $autreOffre])
        @endforeach
    </div><br>
@endif

{{-- Formulaire de postulation (candidat uniquement, si pas déjà postulé) --}}
@if(auth()->user()->role === 'candidat' && !$candidatConnecte->offres->contains($offre->id))
    <h2 class="h1-show" style="margin-top: 60px;">Postuler à cette offre</h2>
    <div class="card" style="padding:20px;">
        <form id="postulerForm" action="{{ route('candidats.store') }}" method="POST">
            @csrf
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">
            <input type="hidden" name="candidat_id" value="{{ $candidatConnecte->id }}">

            <p style="color:#ccc;">
                Vous postulez avec votre profil : 
                <strong>{{ $candidatConnecte->nom }} {{ $candidatConnecte->prenom }}</strong>
            </p>

            <button type="submit" style="margin-top:15px; background-color:#4CAF50; color:#fff; border:none; padding:10px 16px; border-radius:6px; cursor:pointer; font-weight:bold;">
                <i class="fas fa-paper-plane"></i> Postuler
            </button>
        </form>
    </div>
@elseif(auth()->user()->role === 'candidat')
    <p style="margin-top:20px; color:#f44336;">
        Vous avez déjà postulé à cette offre.
    </p>
@endif


{{-- Liste des candidats ayant postulé (visible uniquement pour entreprise/admin) --}}
@if(auth()->user()->role !== 'candidat' && $offre->candidats->count() > 0)
    <h2 class="h1-show" style="margin-top: 60px;">Candidats ayant postulé</h2>
    <div class="liste_candidats" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        @foreach($offre->candidats as $candidat)
            <div class="CandidatCard" style="position: relative; padding: 20px; background-color: #1f1f1f; border-radius: 12px;">
                <h3>{{ $candidat->nom }} {{ $candidat->prenom }}</h3>
                <p style="color:#ccc;"><i class="fas fa-envelope" style="color:#00bcd4;"></i> {{ $candidat->mail }}</p>
                <p style="color:#ccc;"><i class="fas fa-phone" style="color:#ff0000;"></i> {{ $candidat->telephone }}</p>

                <div style="margin-top:10px; display:flex; gap:10px;">
                    <a href="{{ route('candidats.show', $candidat->id) }}" 
                       style="background-color:#4caf50; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none;">
                        <i class="fas fa-eye"></i> Voir
                    </a>

                    {{-- Bouton retirer pour entreprise ou admin uniquement --}}
                    @if(auth()->user()->isAdmin() || (auth()->user()->isEntreprise() && auth()->user()->id === $offre->entreprise_id))
                        <form id="delete-candidat-{{ $candidat->id }}-admin" 
                              action="{{ route('candidats.destroy', $candidat->id) }}" 
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="offre_id" value="{{ $offre->id }}">
                            <button type="submit" 
                                    onclick="return confirm('Voulez-vous vraiment retirer ce candidat ?');"
                                    style="background-color:#ff9800; color:#fff; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">
                                <i class="fas fa-user-times"></i> Retirer
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif


@endsection
