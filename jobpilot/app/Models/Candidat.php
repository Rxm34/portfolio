<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $table='candidats';

    protected $fillable = ['nom', 'prenom', 'date_naissance', 'mail', 'telephone', 'adresse', 'ville'];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function offres()
    {
        return $this->belongsToMany(Offre::class, 'candidats_offres');
    }  
}
