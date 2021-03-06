<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisObj extends Model
{
    use HasFactory;
    protected $fillable = [
        'obj_id',
        'nom',
        'responsable',
        'ecartement',
        'ha',
        'qts_totale',
    ];
}