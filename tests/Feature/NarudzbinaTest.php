<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Proizvod;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NarudzbinaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function korisnik_moze_da_kreira_narudzbinu()
    {
        $proizvod = Proizvod::factory()->create([
            'cena' => 200
        ]);

        $response = $this->post('/naruci', [
            'ime_kupca' => 'Petar Petrovic',
            'email' => 'petar@test.rs',
            'telefon' => '061234567',
            'proizvod_id' => $proizvod->id,
            'kolicina' => 2,
            'adresa' => 'Beograd'
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('narudzbine', [
            'ime_kupca' => 'Petar Petrovic'
        ]);
    }
}
