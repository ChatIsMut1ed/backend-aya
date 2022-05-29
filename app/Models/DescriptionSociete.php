<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionSociete extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'adresse',
        'email',
        'num_bank',
        'tel',
        'ref_tva',
    ];
}