<?php

namespace App\Http\Controllers;

use App\Models\Narudzbina;
use Illuminate\Http\Request;

class NaruciController extends Controller
{
    public function create()
    {
        return view('naruci.create');
    }

    public function store(Request $request)
    {
        // Validacija svih polja koja test šalje
        $validated = $request->validate([
            'ime_kupca'   => 'required|string|max:100',
            'email'       => 'required|email|max:100',
            'telefon'     => 'required|string|max:20',
            'proizvod_id' => 'required|exists:proizvods,id',
            'kolicina'    => 'required|integer|min:1',
            'ukupna_cena' => 'required|numeric|min:0',
            'adresa'      => 'required|string',
        ]);

        // Generisanje broja narudžbine
        $broj_narudzbine = 'NAR-' . date('Ymd') . '-' . str_pad(Narudzbina::count() + 1, 4, '0', STR_PAD_LEFT);

        // Upis u bazu
        Narudzbina::create([
            'broj_narudzbine' => $broj_narudzbine,
            'ime_kupca'       => $validated['ime_kupca'],
            'email'           => $validated['email'],
            'telefon'         => $validated['telefon'],
            'proizvod_id'     => $validated['proizvod_id'],
            'kolicina'        => $validated['kolicina'],
            'ukupna_cena'     => $validated['ukupna_cena'],
            'adresa'          => $validated['adresa'],
            'status'          => 'u_obradi',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Narudžbina je uspešno kreirana!')
            ->with('narudzbina_broj', $broj_narudzbine)
            ->with('ukupna_cena', $validated['ukupna_cena']);
    }
}
