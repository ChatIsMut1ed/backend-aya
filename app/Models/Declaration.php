<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    use HasFactory;
    protected $fillable = [
        'resg_Dec',
        'resg_Enr',
        'resg_projet',
        'licence_projet',
        'lieu_projet',
        'emplois',
        'caracte_projet',
        'struct_finance',
        'declaration_equip',
        'mat_per_semi',
        'calendrier',
        'resg_inst_droite',
        'liv_cert_per_inves',
        'incitation_requises',
        'repar_capital_social',
    ];
}