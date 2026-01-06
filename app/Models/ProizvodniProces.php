<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProizvodniProces extends Model
{
    use HasFactory;

    protected $table = 'proizvodni_proces'; // tabela u bazi

    protected $fillable = [
        'broj_serije',        
        'proizvod_id',
        'vrsta_cokolade_id',
        'kolicina_proizvoda',
        'datum_pocetka',
        'datum_zavrsetka',
        'status',
        'napomena',
        'ukupna_cena',
    ];

    // Relacija ka proizvodu
    public function proizvod()
    {
        return $this->belongsTo(Proizvod::class);
    }

    // Relacija ka vrsti čokolade
    public function vrstaCokolade()
    {
        return $this->belongsTo(VrstaCokolade::class, 'vrsta_cokolade_id');
    }
}
