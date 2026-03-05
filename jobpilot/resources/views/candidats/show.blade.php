@extends('layouts.app')

@section('content')
<div class="container-show" style="display:flex; justify-content:center;">
    <div class="card">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="h1-show-candidat" style="margin-top:0; font-size:2rem;">
            {{ $candidat->nom }} {{ $candidat->prenom }}
        </h1>

        <p class="info" style="margin-top:50px;">
            <i class="fas fa-birthday-cake" style="color:#e91e63; margin-right:6px;"></i> 
            <strong>Date de naissance :</strong> {{ $candidat->date_naissance->format('d-m-Y') }}
        </p>
        <p class="info">
            <i class="fas fa-envelope" style="color:#00bcd4; margin-right:6px;"></i> 
            <strong>Email :</strong> {{ $candidat->mail }}
        </p>
        <p class="info">
            <i class="fas fa-phone" style="color:#ff0000; margin-right:6px;"></i> 
            <strong>Téléphone :</strong> {{ $candidat->telephone }}
        </p>
        <p class="info">
            <i class="fas fa-map-marker-alt" style="color:#ff9800; margin-right:6px;"></i> 
            <strong>Adresse :</strong> {{ $candidat->adresse }}
        </p>
        <p class="info">
            <i class="fas fa-city" style="color:#4caf50; margin-right:6px;"></i> 
            <strong>Ville :</strong> {{ $candidat->ville }}
        </p>

        <div style="margin-top: 25px; text-align: right;">
            <button type="button" 
                    onclick="window.location='{{ route('candidats.index') }}'" 
                    style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:8px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                <i class="fas fa-arrow-left"></i> Retour aux candidats
            </button>
        </div>
    </div>
</div>

@if($candidat->offres->count() > 0)
    <h2 class="h1-show-candidat" style="margin-top: 60px;">
        Offres auxquelles {{ $candidat->nom }} {{ $candidat->prenom }} a postulé
    </h2>
    <div class="liste_offres" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:20px; margin-top:25px;">
        @foreach($candidat->offres as $offre)
            @include('components.OffreCard',['offre' => $offre])
        @endforeach
    </div>
@endif
@endsection
