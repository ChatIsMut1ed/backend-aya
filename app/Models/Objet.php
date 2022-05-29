<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'unite',
        'prix_unitaire',
        'superficie',
        'qts_par_h',
    ];
}