<div class="OffreCard" 
     style="position:relative; background:#1e1e1e; padding:20px; border-radius:10px; margin-bottom:15px; box-shadow:0 0 10px rgba(0,0,0,0.3);">

    <div>
        <h3 style="margin-top:-4px;">
            <i class="fas fa-briefcase" style="color:#00bcd4; margin-right:8px;"></i>
            {{ $offre->titre }}
        </h3>

        <p><strong><i class="fas fa-building" style="color:#4caf50;"></i> Entreprise :</strong> {{ $offre->entreprise->nom }}</p>
        <p><strong><i class="fas fa-map-marker-alt" style="color:#ff9800;"></i> Lieu :</strong> {{ $offre->lieu }}</p>

        <p>
            <strong><i class="fas fa-file-contract" style="color:#2196f3;"></i> Type de contrat :</strong>
            <span class="badge badge-{{ strtolower($offre->type_contrat) }}">
                {{ $offre->type_contrat }}
            </span>
        </p>

        <p><strong><i class="fas fa-calendar-alt" style="color:#9c27b0;"></i> Publié le </strong> {{ $offre->date_publication->format('d/m/Y') }}</p>
    </div>

    <div style="margin-top:20px; display:flex; justify-content:space-between; align-items:center;">
        <a href="{{ route('offres.show', $offre->id) }}" class="voir-offre">
            <i class="fas fa-eye"></i> Voir l'offre
        </a>

        @if(auth()->user()->isAdmin() || (auth()->user()->isEntreprise() && auth()->user()->entreprise->id === $offre->entreprise_id))
            <div style="display:flex; gap:12px;">
                <a href="{{ route('offres.edit', $offre->id) }}" title="Modifier" class="icon-link" 
                   style="color:#00bcd4; font-size:18px; transition:transform 0.2s;">
                    <i class="fas fa-pencil-alt"></i>
                </a>

                <a href="#" 
                   onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')) { document.getElementById('delete-offre-{{ $offre->id }}').submit(); }"
                   title="Supprimer" 
                   class="icon-link delete"
                   style="color:#f44336; font-size:18px; transition:transform 0.2s;">
                    <i class="fas fa-trash-alt"></i>
                </a>

                <form id="delete-offre-{{ $offre->id }}" 
                      action="{{ route('offres.destroy', $offre->id) }}" 
                      method="POST" 
                      style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        @endif
    </div>
</div>
