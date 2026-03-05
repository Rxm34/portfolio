@extends('layouts.app') <!-- Hérite du layout principal -->

@section('content')
<div class="container-show" style="display:flex; justify-content:center;">
    <div class="card">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="h1-show-entreprise" style="margin-top:0; font-size:2rem;">{{ $entreprise->nom }}</h1>

        <p class="info" style="margin-top:50px;">
            <i class="fas fa-envelope" style="color:#00bcd4; margin-right:6px;"></i>
            <strong>Email :</strong> {{ $entreprise->mail }}
        </p>
        <p class="info">
            <i class="fas fa-phone" style="color:#ff0000; margin-right:6px;"></i>
            <strong>Téléphone :</strong> {{ $entreprise->telephone }}
        </p>
        <p class="info">
            <i class="fas fa-map-marker-alt" style="color:#ff9800; margin-right:6px;"></i>
            <strong>Adresse :</strong> {{ $entreprise->adresse }}
        </p>
        <p class="info">
            <i class="fas fa-align-left" style="color:#00bcd4; margin-right:6px;"></i>
            <strong>Description :</strong><br>{{ $entreprise->description }}
        </p>

        <div style="margin-top: 25px; text-align: right;">
            <button type="button" 
                    onclick="window.location='{{ route('entreprises.index') }}'" 
                    style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:8px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                <i class="fas fa-arrow-left"></i> Retour aux entreprises
            </button>
        </div>
    </div>
</div>

@if($entreprise->offres->count() > 0)
    <h2 class="h1-show-entreprise" style="margin-top: 60px;">Offres proposées par {{ $entreprise->nom }}</h2>
    <div class="liste_offres" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:20px; margin-top:25px;">
        @foreach($entreprise->offres as $offre)
            @include('components.OffreCard',['offre' => $offre])
        @endforeach
    </div>
@endif
@endsection
