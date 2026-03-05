<div class="CandidatCard">
    <div>
        <h3 style="margin-top:-4px;">
            <i class="fas fa-user" style="color:#00bcd4; margin-right:8px;"></i>
            {{ $candidat->nom }} {{ $candidat->prenom }}
        </h3>

        <p style="color:#ccc;">
            <strong><i class="fas fa-envelope" style="color:#00bcd4; margin-right:6px;"></i> Email :</strong> 
            {{ $candidat->mail }}
        </p>
        <p style="color:#ccc;">
            <strong><i class="fas fa-phone" style="color:#ff0000; margin-right:6px;"></i> Téléphone :</strong> 
            {{ $candidat->telephone }}
        </p>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('candidats.show', $candidat->id) }}" class="voir-candidat">
            <i class="fas fa-eye"></i> Voir le candidat
        </a>

        <div style="display: flex; gap: 12px;">
            @if(auth()->user()->isAdmin() || (auth()->user()->isCandidat() && auth()->user()->id === $candidat->id))
                <a href="{{ route('candidats.edit', $candidat->id) }}" 
                   title="Modifier" 
                   class="icon-link" 
                   style="color:#00bcd4; font-size:18px; transition: transform 0.2s;">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            @endif

            @if(auth()->user()->isAdmin())
                <a href="#" 
                   onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')) { document.getElementById('delete-candidat-{{ $candidat->id }}').submit(); }"
                   title="Supprimer" 
                   class="icon-link delete"
                   style="color:#f44336; font-size:18px; transition: transform 0.2s;">
                    <i class="fas fa-trash-alt"></i>
                </a>

                <form id="delete-candidat-{{ $candidat->id }}" action="{{ route('candidats.destroy', $candidat->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    </div>
</div>
