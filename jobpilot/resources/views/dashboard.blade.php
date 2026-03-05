@extends('layouts.app')

@section('content')
<div class="container" style="max-width:1200px; margin:auto; padding:20px; color:white;">
    <h1 style="text-align:center; margin-bottom:30px;">Tableau de bord</h1>

    @php $role = Auth::user()->role ?? 'candidat'; @endphp

    {{-- ADMIN --}}
    @if($role === 'admin')
        <div style="display:flex; gap:20px; flex-wrap:wrap; justify-content:center; margin-bottom:40px;">
            <div style="flex:1 1 200px; background:#2196f3; color:#fff; padding:20px; border-radius:10px; text-align:center;">
                <h3>Total Offres</h3>
                <p style="font-size:2rem; font-weight:bold;">{{ $totalOffres }}</p>
            </div>
            <div style="flex:1 1 200px; background:#4caf50; color:#fff; padding:20px; border-radius:10px; text-align:center;">
                <h3>Total Entreprises</h3>
                <p style="font-size:2rem; font-weight:bold;">{{ $totalEntreprises }}</p>
            </div>
            <div style="flex:1 1 200px; background:#ff9800; color:#fff; padding:20px; border-radius:10px; text-align:center;">
                <h3>Total Candidats</h3>
                <p style="font-size:2rem; font-weight:bold;">{{ $totalCandidats }}</p>
            </div>
        </div>

        {{-- Derniers ajouts --}}
        <div style="display:flex; gap:20px; flex-wrap:wrap; justify-content:center; margin-bottom:50px;">
            <div style="flex:1 1 300px;">
                <h3>Dernière Offre</h3>
                @if($lastOffre)
                    @include('components.OffreCard', ['offre' => $lastOffre])
                @else
                    <p>Aucune offre disponible.</p>
                @endif
            </div>
            <div style="flex:1 1 300px;">
                <h3>Dernière Entreprise</h3>
                @if($lastEntreprise)
                    @include('components.EntrepriseCard', ['entreprise' => $lastEntreprise])
                @else
                    <p>Aucune entreprise disponible.</p>
                @endif
            </div>
            <div style="flex:1 1 300px;">
                <h3>Dernier Candidat</h3>
                @if($lastCandidat)
                    @include('components.CandidatCard', ['candidat' => $lastCandidat])
                @else
                    <p>Aucun candidat disponible.</p>
                @endif
            </div>
        </div>

        {{-- Gestion utilisateurs --}}
        <div style="background:#1b1b1b; padding:20px; border-radius:10px;">
            <h2 style="text-align:center; margin-bottom:20px;">Gestion des utilisateurs</h2>
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#333;">
                        <th style="padding:10px; border-bottom:1px solid #444;">Nom</th>
                        <th style="padding:10px; border-bottom:1px solid #444;">Email</th>
                        <th style="padding:10px; border-bottom:1px solid #444;">Rôle</th>
                        <th style="padding:10px; border-bottom:1px solid #444;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $userItem)
                        <tr style="text-align:center;">
                            <td style="padding:10px; border-bottom:1px solid #444;">{{ $userItem->name }}</td>
                            <td style="padding:10px; border-bottom:1px solid #444;">{{ $userItem->email }}</td>
                            <td style="padding:10px; border-bottom:1px solid #444;">
                                <form method="POST" action="{{ route('admin.updateRole', $userItem->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" onchange="this.form.submit()" 
                                            style="background:#121212; color:#fff; border:1px solid #555; padding:5px; border-radius:5px;">
                                        <option value="admin" {{ $userItem->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="entreprise" {{ $userItem->role === 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                                        <option value="candidat" {{ $userItem->role === 'candidat' ? 'selected' : '' }}>Candidat</option>
                                    </select>
                                </form>
                            </td>
                            <td style="padding:10px; border-bottom:1px solid #444;">
                                @if(auth()->id() !== $userItem->id)
                                    <form method="POST" action="{{ route('admin.deleteUser', $userItem->id) }}" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:#f44336; color:#fff; border:none; padding:6px 12px; border-radius:5px; cursor:pointer;">
                                            Supprimer
                                        </button>
                                    </form>
                                @else
                                    <span style="color:#999;">(vous)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    {{-- ENTREPRISE --}}
    @elseif($role === 'entreprise')
        <div style="text-align:center; margin-bottom:30px;">
            <h2 style="color:#fff; font-size:28px;">Bienvenue sur votre espace entreprise 👔</h2>
            <p style="color:#ccc;">Voici un aperçu de votre activité :</p>
        </div>

        <div style="display:flex; justify-content:center; gap:20px; margin:30px 0; flex-wrap:wrap;">
            <div style="background:#2196f3; padding:20px; border-radius:10px; text-align:center; min-width:200px; flex:1;">
                <h3 style="color:#fff;">Vos offres publiées</h3>
                <p style="font-size:2rem; font-weight:bold; color:#fff;">{{ $offresCount }}</p>
            </div>
            <div style="background:#4caf50; padding:20px; border-radius:10px; text-align:center; min-width:200px; flex:1;">
                <h3 style="color:#fff;">Candidatures reçues</h3>
                <p style="font-size:2rem; font-weight:bold; color:#fff;">{{ $candidaturesCount }}</p>
            </div>
        </div>

        <div class="liste_offres" style="margin:30px 0;">
            @forelse($offres as $offre)
                <div style="margin-bottom:20px;">
                    @include('components.OffreCard', ['offre' => $offre])
                </div>
            @empty
                <p style="text-align:center; color:#ccc;">Aucune offre publiée pour le moment.</p>
            @endforelse
        </div>

        <div style="text-align:center; margin:30px 0;">
            <a href="{{ route('offres.create') }}" style="background:#2196f3; color:white; padding:12px 25px; border-radius:5px; text-decoration:none; font-weight:bold;">
                + Créer une nouvelle offre
            </a>
        </div>

            {{-- CANDIDAT --}}
        @else
            <div style="text-align:center; margin-bottom:30px;">
                <h2>Bienvenue sur votre espace candidat 🎓</h2>
                <p>Voici un résumé de vos candidatures :</p>
            </div>

            <div style="display:flex; gap:20px; flex-wrap:wrap; justify-content:center; margin:40px 0;">
                <div style="flex:1 1 200px; background:#2196f3; padding:20px; border-radius:10px; text-align:center;">
                    <h3>Candidatures envoyées</h3>
                    <p style="font-size:2rem; font-weight:bold;">{{ $candidaturesEnvoyees }}</p>
                </div>
            </div>

            <div class="liste_offres" style="margin:30px 0;">
                @forelse($offres as $offre)
            <div style="margin-bottom:20px; position:relative;">
                @include('components.OffreCard', ['offre' => $offre])
                <form id="delete-candidat-{{ $candidatConnecte->id }}" 
                    action="{{ route('candidats.destroy', $candidatConnecte->id) }}" 
                    method="POST" 
                    style="position:absolute; bottom:30px; right:20px;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="offre_id" value="{{ $offre->id }}">

                    <a href="#" 
                    onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer cette candidature ?')) { document.getElementById('delete-candidat-{{ $candidatConnecte->id }}').submit(); }"
                    title="Supprimer" 
                    class="icon-link delete"
                    style="color:#f44336; font-size:18px; transition:transform 0.2s;">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>

            </div>
        @empty
            <p style="text-align:center; color:#ccc;">Vous n'avez postulé à aucune offre pour le moment.</p>
        @endforelse
    </div>
@endif
</div>
@endsection
