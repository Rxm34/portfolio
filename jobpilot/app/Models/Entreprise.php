<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $table = 'entreprises';

    protected $fillable = [
        'nom',
        'description',
        'mail',
        'telephone',
        'adresse',
    ];

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}
