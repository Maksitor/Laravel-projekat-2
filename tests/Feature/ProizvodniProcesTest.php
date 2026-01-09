<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ProizvodniProces;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProizvodniProcesSimpleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function proizvodni_proces_moze_biti_kreiran()
    {
        $proces = ProizvodniProces::create([
            'naziv' => 'Test Proces',
            'opis'  => 'Opis test procesa',
            'status'=> 'aktivan'
        ]);

        $this->assertDatabaseHas('proizvodni_proceses', [
            'naziv' => 'Test Proces'
        ]);
    }
}
