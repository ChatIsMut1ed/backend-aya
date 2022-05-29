<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillale = [
        'fullname',
        'gender',
        'tn_abroad',
        'country',
        'birthday_date',
        'study_grade',
        'diploma',
        'capacity',
        'social_purpose',
        'cin',
        'cin_place',
        'adresse',
        'city',
        'code_postal',
        'phone_number',
        'fax',
        'email',
    ];
}