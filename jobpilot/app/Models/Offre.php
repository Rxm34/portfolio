<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $table = 'offres';

    protected $fillable = [
        'titre',
        'entreprise_id',
        'lieu',
        'date_publication',
        'type_contrat',
        'salaire',
        'description',
    ];

    protected $casts = [
        'date_publication' => 'date',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function candidats()
    {
        return $this->belongsToMany(Candidat::class, 'candidats_offres', 'offre_id', 'candidat_id');
    }
}
