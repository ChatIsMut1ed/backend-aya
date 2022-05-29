<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mat extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'unite',
        'prix_unitaire',
    ];
}