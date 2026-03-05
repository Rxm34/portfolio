<div class="EntrepriseCard">
    <div>
        <h3 style="margin-top:-4px;">
            <i class="fas fa-building" style="color:#00bcd4; margin-right:8px;"></i>
            {{ $entreprise->nom }}
        </h3>

        <p style="color:#ccc;">
            <strong><i class="fas fa-envelope" style="color:#00bcd4; margin-right:6px;"></i> Email :</strong> 
            {{ $entreprise->mail }}
        </p>
        <p style="color:#ccc;">
            <strong><i class="fas fa-phone" style="color:#ff0000; margin-right:6px;"></i> Téléphone :</strong> 
            {{ $entreprise->telephone }}
        </p>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('entreprises.show', $entreprise->id) }}" class="voir-entreprise">
            <i class="fas fa-eye"></i> Voir l'entreprise
        </a>

        <div style="display: flex; gap: 12px;">
            @if(auth()->user()->isAdmin() || (auth()->user()->isEntreprise() && auth()->user()->id === $entreprise->id))
                <a href="{{ route('entreprises.edit', $entreprise->id) }}" 
                   title="Modifier" 
                   class="icon-link" 
                   style="color:#00bcd4; font-size:18px; transition: transform 0.2s;">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            @endif

            @if(auth()->user()->isAdmin())
                <a href="#" 
                   onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')) { document.getElementById('delete-entreprise-{{ $entreprise->id }}').submit(); }"
                   title="Supprimer" 
                   class="icon-link delete"
                   style="color:#f44336; font-size:18px; transition: transform 0.2s;">
                    <i class="fas fa-trash-alt"></i>
                </a>

                <form id="delete-entreprise-{{ $entreprise->id }}" action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    </div>
</div>
