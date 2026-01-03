<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Sirovina;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SirovineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function stranica_stanja_sirovina_je_dostupna()
    {
        Sirovina::factory()->count(3)->create();

        $response = $this->get('/sirovine');

        $response->assertStatus(200);
        $response->assertSee('Stanje sirovina');
    }
}
