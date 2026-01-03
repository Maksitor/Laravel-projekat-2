<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Proizvod;
use App\Models\VrstaCokolade;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProizvodniProcesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_moze_da_kreira_proizvodni_proces()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $proizvod = Proizvod::factory()->create();
        $vrsta = VrstaCokolade::factory()->create();

        $response = $this->actingAs($admin)->post('/proizvodni-procesi', [
            'broj_serije' => 'SER-001',
            'proizvod_id' => $proizvod->id,
            'vrsta_cokolade_id' => $vrsta->id,
            'datum_pocetka' => now()->toDateString(),
            'kolicina_proizvedena' => 100,
            'status' => 'planirano'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('proizvodni_procesi', [
            'broj_serije' => 'SER-001'
        ]);
    }
}
