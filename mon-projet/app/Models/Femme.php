<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Femme extends Model
{
    use HasFactory;

  protected $fillable = [
    'nom',
    'prenom',
    'activite',
    'telephone',
    'sexe',
    'paiement_status',
    'qr_code_path',
];
}
