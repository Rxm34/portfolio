@extends('layouts.app')

@section('content')
    <div class="page-header">
        @php
            $role = Auth::user()->role ?? 'candidat';
            $titre = match($role) {
                'admin' => 'Liste des entreprises',
                'candidat' => 'Entreprises disponibles',
                default => 'Entreprises',
            };
        @endphp

        <h1>{{ $titre }}</h1>

        @if($role === 'admin')
            <div style="text-align: right; margin-top: -30px;">
                <a href="{{ route('entreprises.create') }}" class="btn-create">Ajouter une entreprise</a>
            </div>
        @endif
    </div>
    <br>

    @if(session('success'))
        <div style="background-color: #4caf50; color: #fff; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="liste_entreprises">
        @foreach ($entreprises as $entreprise)
            <x-EntrepriseCard :entreprise="$entreprise" />
        @endforeach
    </div>
@endsection
