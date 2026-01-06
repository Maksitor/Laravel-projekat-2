<?php

namespace App\Http\Controllers;

use App\Models\Narudzbina;
use Illuminate\Http\Request;

class NaruciController extends Controller
{
    public function create()
    {
        // Nema potrebe za proizvodima jer tabela ne sadrži proizvod_id
        return view('naruci.create');
    }

    public function store(Request $request)
    {
        // Validacija polja koja stvarno postoje u tabeli
        $validated = $request->validate([
            'ime_kupca' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefon' => 'required|string|max:20',
            'adresa' => 'required|string',
            'ukupna_cena' => 'required|numeric|min:0', // cena se može poslati iz forme
        ]);

        // Generisanje broja narudžbine
        $broj_narudzbine = 'NAR-' . date('Ymd') . '-' . str_pad(Narudzbina::count() + 1, 4, '0', STR_PAD_LEFT);

        // Kreiranje narudžbine
        Narudzbina::create([
            'ime_kupca' => $validated['ime_kupca'],
            'email' => $validated['email'],
            'telefon' => $validated['telefon'],
            'adresa' => $validated['adresa'],
            'ukupna_cena' => $validated['ukupna_cena'],
            'broj_narudzbine' => $broj_narudzbine,
            // 'status' se ne mora slati jer ima default
        ]);

        return redirect()->back()->with('success', 'Narudžbina je uspešno kreirana!')
                                 ->with('narudzbina_broj', $broj_narudzbine)
                                 ->with('ukupna_cena', $validated['ukupna_cena']);
    }
}
