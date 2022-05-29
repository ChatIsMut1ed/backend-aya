<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeForageEau extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_postulant',
        'prenom',
        'cin',
        'date',
        'date_disposition',
        'adresse',
        'tel',
        'gouvernorat',
        'decanat',
        'superficie',
        'type_projet',
        'remarque',
        'type_plante',
        'date_signature',
    ];
}