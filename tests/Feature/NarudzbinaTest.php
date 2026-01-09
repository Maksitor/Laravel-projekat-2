<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Narudzbina;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NarudzbinaSimpleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function narudzbina_moze_biti_kreirana()
    {
        // Kreiramo narudžbinu direktno u bazi
        $narudzbina = Narudzbina::create([
            'ime_kupca'       => 'Petar Petrovic',
            'email'           => 'petar@test.rs',
            'telefon'         => '061234567',
            'adresa'          => 'Beograd',
            'proizvod_id'     => 1,       // Ovo mora postojati u proizvods tabeli
            'kolicina'        => 2,
            'ukupna_cena'     => 400.00,
            'broj_narudzbine' => 'NAR-20260109-0001',
            'status'          => 'u_obradi'
        ]);

        // Proveravamo da li je upis uspješan
        $this->assertDatabaseHas('narudzbinas', [
            'ime_kupca' => 'Petar Petrovic',
            'ukupna_cena' => 400.00
        ]);
    }
}
