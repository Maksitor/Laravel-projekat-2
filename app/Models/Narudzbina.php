<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narudzbina extends Model
{
    use HasFactory;

    protected $table = 'narudzbinas';

    protected $fillable = [
        'ime_kupca',
        'email',
        'telefon',
        'adresa',
        'napomena',
        'broj_narudzbine',
        'ukupna_cena',
        'proizvod_id',   // OBAVEZNO dodati
        'kolicina'       // OBAVEZNO dodati
    ];

    public function proizvod()
    {
        return $this->belongsTo(Proizvod::class, 'proizvod_id');
    }
}
