<?php

namespace App\Http\Controllers;

use App\Models\ProizvodniProces;
use App\Models\Proizvod;
use App\Models\VrstaCokolade;
use App\Models\Sirovina;
use Illuminate\Http\Request;

class ProizvodniProcesController extends Controller
{
    // ----------- JAVNE METODE (za sve korisnike) -----------
    
    /**
     * Prikaži listu proizvodnih procesa - JAVNA STRANA
     * Ova metoda se poziva kada neko ode na /proizvodni-procesi
     */
    public function index()
    {
        // Ovo je VAŠ POSTOJEĆI PUBLIC VIEW
        $procesi = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])->paginate(10);
        return view('proizvodni-procesi.index', compact('procesi'));
    }

    /**
     * Prikaži pojedinačni proces - JAVNI DETALJI
     * Ova metoda se poziva kada neko ode na /proizvodni-procesi/{id}
     */
    public function show($id)
    {
        // Ovo je VAŠ POSTOJEĆI PUBLIC SHOW
        $proces = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])->findOrFail($id);
        return view('proizvodni-procesi.show', compact('proces'));
    }

    // ----------- ADMIN METODE (samo za admin panel) -----------
    
    /**
     * ADMIN: Prikaži listu svih procesa (admin panel)
     * Ova metoda se poziva kada admin ode na /admin/proizvodni-procesi
     */
    public function adminIndex()
    {
        $procesi = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])->paginate(10);
        return view('admin.proizvodni-procesi.index', compact('procesi'));
    }

    /**
     * ADMIN: Prikaži formu za kreiranje novog procesa
     */
    public function create()
    {
        $proizvodi = Proizvod::all();
        $vrste = VrstaCokolade::all();
        $sirovine = Sirovina::all();
        
        return view('admin.proizvodni-procesi.create', compact('proizvodi', 'vrste', 'sirovine'));
    }

    /**
     * ADMIN: Sačuvaj novi proces
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'broj_serije' => 'required|string|max:50|unique:proizvodni_procesi,broj_serije',
            'proizvod_id' => 'required|exists:proizvodi,id',
            'vrsta_cokolade_id' => 'required|exists:vrste_cokolade,id',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'nullable|date|after:datum_pocetka',
            'status' => 'required|in:planiran,u_toku,zavrseno',
            'kolicina_proizvedena' => 'required|integer|min:1',
            'ukupna_cena' => 'nullable|numeric|min:0',
        ]);

        ProizvodniProces::create($validated);

        return redirect()->route('admin.proizvodni-procesi.index')
            ->with('success', 'Proizvodni proces uspešno kreiran!');
    }

    /**
     * ADMIN: Prikaži detalje procesa (admin panel)
     * Ova metoda se poziva kada admin klikne na DETALJI dugme
     */
    public function adminShow($id)
    {
        $proces = ProizvodniProces::with(['proizvod', 'vrstaCokolade'])->findOrFail($id);
        return view('admin.proizvodni-procesi.show', compact('proces'));
    }

    /**
     * ADMIN: Prikaži formu za izmenu procesa
     */
    public function edit($id)
    {
        $proces = ProizvodniProces::findOrFail($id);
        $proizvodi = Proizvod::all();
        $vrste = VrstaCokolade::all();
        $sirovine = Sirovina::all();
        
        return view('admin.proizvodni-procesi.edit', compact('proces', 'proizvodi', 'vrste', 'sirovine'));
    }

    /**
     * ADMIN: Ažuriraj proces
     */
    public function update(Request $request, $id)
    {
        $proces = ProizvodniProces::findOrFail($id);
        
        $validated = $request->validate([
            'broj_serije' => 'required|string|max:50|unique:proizvodni_procesi,broj_serije,' . $proces->id,
            'proizvod_id' => 'required|exists:proizvodi,id',
            'vrsta_cokolade_id' => 'required|exists:vrste_cokolade,id',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'nullable|date|after:datum_pocetka',
            'status' => 'required|in:planiran,u_toku,zavrseno',
            'kolicina_proizvedena' => 'required|integer|min:1',
            'ukupna_cena' => 'nullable|numeric|min:0',
        ]);

        $proces->update($validated);

        return redirect()->route('admin.proizvodni-procesi.index')
            ->with('success', 'Proizvodni proces uspešno ažuriran!');
    }

    /**
     * ADMIN: Obriši proces
     */
    public function destroy($id)
    {
        $proces = ProizvodniProces::findOrFail($id);
        $proces->delete();

        return redirect()->route('admin.proizvodni-procesi.index')
            ->with('success', 'Proizvodni proces uspešno obrisan!');
    }
}