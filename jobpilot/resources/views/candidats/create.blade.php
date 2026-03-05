@extends('layouts.app')

@section('content')
<div class="container-show">
    <div class="card">
        <h1 class="h1-show" style="margin-top:-4px;">Ajouter un nouveau candidat</h1>

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

        <form action="{{ route('candidats.store') }}" method="POST">
            @csrf

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Nom du candidat" required>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom du candidat" required>

            <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" required>

            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" placeholder="exemple@mail.com" required>

            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" placeholder="Ex : 06 12 34 56 78" required>

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" placeholder="Adresse complète" required>

            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" placeholder="Ville" required>

            <div style="margin-top:25px; display:flex; gap:12px; justify-content:flex-end;">
                <button type="submit" 
                        style="background-color:#4CAF50; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    <i class="fas fa-check"></i> Ajouter le candidat
                </button>

                <button type="button"
                        onclick="window.location='{{ route('candidats.index') }}'"
                        style="background-color:#2196f3; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer; transition: background-color 0.3s;">
                    <i class="fas fa-arrow-left"></i> Annuler
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
