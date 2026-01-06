<?php

namespace App\Http\Controllers;

use App\Models\ProizvodniProces;
use App\Models\Proizvod;
use App\Models\VrstaCokolade;
use App\Models\Sirovina;
use Illuminate\Http\Request;

class ProizvodniProcesController extends Controller
{
    // -------- JAVNE METODE --------

    public function indexPublic()
    {
        $procesi = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])
            ->where('status', 'zavrsen')
            ->orderBy('datum_zavrsetka', 'desc')
            ->paginate(10);
        return view('proizvodni-procesi.index', compact('procesi'));
    }

    public function show($id)
    {
        $proces = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])->findOrFail($id);
        return view('proizvodni-procesi.show', compact('proces'));
    }

    // -------- ADMIN METODE --------

    public function index()
    {
        $procesi = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])->paginate(10);
        return view('proizvodni-procesi.index', compact('procesi'));
    }

    public function create()
    {
        $proizvodi = Proizvod::all();
        $vrste = VrstaCokolade::all();
        $sirovine = Sirovina::all();

        return view('admin.proizvodni-procesi.create', compact('proizvodi', 'vrste', 'sirovine'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'broj_serije' => 'required|string|max:50|unique:proizvodni_proces,broj_serije',
            'proizvod_id' => 'required|exists:proizvods,id',
            'vrsta_cokolade_id' => 'required|exists:vrsta_cokolades,id',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'nullable|date|after:datum_pocetka',
            'status' => 'required|in:planiran,u_toku,zavrseno',
            'kolicina_proizvoda' => 'required|integer|min:1',
            'ukupna_cena' => 'nullable|numeric|min:0',
        ]);

        ProizvodniProces::create($validated);

        return redirect()->route('admin.proizvodni-procesi.index')
            ->with('success', 'Proizvodni proces uspešno kreiran!');
    }

    public function edit($id)
    {
        $proces = ProizvodniProces::findOrFail($id);
        $proizvodi = Proizvod::all();
        $vrste = VrstaCokolade::all();
        $sirovine = Sirovina::all();

        return view('admin.proizvodni-procesi.edit', compact('proces', 'proizvodi', 'vrste', 'sirovine'));
    }

    public function update(Request $request, $id)
    {
        $proces = ProizvodniProces::findOrFail($id);

        $validated = $request->validate([
            'serijski_broj' => 'required|string|max:50|unique:proizvodni_proces,serijski_broj,' . $proces->id,
            'proizvod_id' => 'required|exists:proizvods,id',
            'vrsta_cokolade_id' => 'required|exists:vrsta_cokolades,id',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'nullable|date|after:datum_pocetka',
            'status' => 'required|in:planiran,u_toku,zavrseno',
            'kolicina_proizvoda' => 'required|integer|min:1',
        ]);

        $proces->update($validated);

        return redirect()->route('admin.proizvodni-procesi.index')
            ->with('success', 'Proizvodni proces uspešno ažuriran!');
    }

    public function destroy($id)
    {
        $proces = ProizvodniProces::findOrFail($id);
        $proces->delete();

        return redirect()->route('admin.proizvodni-procesi.index')
            ->with('success', 'Proizvodni proces uspešno obrisan!');
    }
}
