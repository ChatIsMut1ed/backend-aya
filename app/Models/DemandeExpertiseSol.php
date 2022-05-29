<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeExpertiseSol extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_postulant',
        'cin',
        'date',
        'adresse',
        'tel',
        'num_frais_im',
        'local',
        'endroit',
        'decanat',
        'delegation',
        'superficie',
        'ut_act_sol',
    ];
}