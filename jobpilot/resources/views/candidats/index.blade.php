@extends('layouts.app')

@section('content')
    <div class="page-header">
        @php
            $role = Auth::user()->role ?? 'candidat';
            $titre = match($role) {
                'admin' => 'Liste des candidats',
                'entreprise' => 'Candidats postulants à mes offres',
            };
        @endphp

        <h1>{{ $titre }}</h1>

        @if($role === 'admin')
            <div style="text-align: right; margin-top: -30px;">
                <a href="{{ route('candidats.create') }}" class="btn-create">Ajouter un candidat</a>
            </div>
        @endif
    </div>
    <br>

    @if(session('success'))
        <div style="background-color: #4caf50; color: #fff; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if($role === 'candidat')
        <div style="color: red; text-align: center; font-weight: bold; margin-top: 20px;">
            Vous n'avez pas accès à cette page.
        </div>
    @else
        <div class="liste_candidats">
            @foreach ($candidats as $candidat)
                <x-CandidatCard :candidat="$candidat" />
            @endforeach
        </div>
    @endif
@endsection
