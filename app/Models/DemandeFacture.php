<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeFacture extends Model
{
    use HasFactory;
    protected $fillable = [
        'qts',
        'date',
        'doit',
        'act_id',
        'des_soc',
        'var_chang',
    ];
}