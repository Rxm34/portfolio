<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Entreprise;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'entreprise_id',
        'telephone',
        'adresse',
        'ville',
    ];


    /**
     * Les attributs cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Vérification des rôles
    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isEntreprise(): bool {
        return $this->role === 'entreprise';
    }

    public function isCandidat(): bool {
        return $this->role === 'candidat';
    }
    
    public function isAdminOrEntreprise(): bool
    {
        return $this->isAdmin() || $this->isEntreprise();
    }

    public function isAdminOrCandidat(): bool
    {
        return $this->isAdmin() || $this->isCandidat();
    }

     public function isAdminOrEntrepriseOrCandidat(): bool
    {
        return $this->isAdmin() || $this->isCandidat() || $this->isEntreprise();
    }


    // Relation vers l'entreprise (si l'utilisateur est une entreprise)
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
