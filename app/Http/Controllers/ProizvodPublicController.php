<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proizvod;

class ProizvodPublicController extends Controller
{
    // Prikaz jednog proizvoda
    public function show($id)
    {
        // Dohvati proizvod po ID iz tabele 'proizvods'
        $proizvod = Proizvod::findOrFail($id);

        // Vrati view i prosledi proizvod
        return view('proizvodi.show', compact('proizvod'));
    }
}
