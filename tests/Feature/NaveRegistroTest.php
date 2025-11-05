<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Planeta;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class NaveRegistroTest extends TestCase
{

    use RefreshDatabase;

    public function test_admin_puede_registrar_una_nave(){
        //creamos un planeta para que exista un planeta_id valido

        $planeta = Planeta::factory()->create();

        //creamos un ususario con el rol de 'admin'
        $admin = User::factory()->create(['role' => 'admin']);

        $nuevaNave = [
            'nombre' => 'Halcón Milenario',
            'modelo' => 'YT-1300',
            'tripulacion' => 10,
            'pasajeros' => 6,
            'clase_nave' => 'Carguero ligero',
            'planeta_id' => $planeta->id
        ];

        //simulamos que el admin ha hecho login
        Sanctum::actingAs($admin,['admin']);

        $response = $this->postJson('/api/naves', $nuevaNave);

        $response->assertStatus(201);
        $response->assertJsonFragment(['nombre' => 'Halcón Milenario']);

        $this->assertDatabaseHas('naves',[
            'nombre' => 'Halcón Milenario'
        ]);
    }
   
}
