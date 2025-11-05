<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Nave;
use App\Models\Piloto;
use App\Models\Planeta;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class IntegracionTest extends TestCase
{
    use RefreshDatabase;

public function test_integracion_piloto_nave_asignar(){
    $admin = User::factory()->create(['role' => 'admin']);
    $planeta = Planeta::factory()->create();

    $datosPiloto = [
        'nombre' => 'Anakin Skywalker',
        'altura' => 188,
        'ano_nacimiento' => '41.9BBY',
        'genero' => 'male',
    ];

    $datosNave = [
        'nombre' => 'Jedi Starfighter',
        'modelo' => 'Delta-7',
        'tripulacion' => 1,
        'pasajeros' => 0,
        'clase_nave' => 'Starfighter',
        'planeta_id' => $planeta->id
    ];

    
    Sanctum::actingAs($admin,['admin']);

    $responsePiloto = $this->postJson('/api/pilotos', $datosPiloto);
    $responsePiloto->assertStatus(201);
    $pilotoId = $responsePiloto->json('piloto.id');

    $responseNave = $this->postJson('/api/naves', $datosNave);
    $responseNave->assertStatus(201);
    $naveId = $responseNave->json('nave.id');

    $responseAsignar = $this->postJson(
        '/api/naves/asignarPiloto/' . $naveId, 
        ['piloto_id' => $pilotoId]
    );

    $responseAsignar->assertStatus(200);

    $this->assertDatabaseHas('nave_piloto', [
        'nave_id' => $naveId,
        'piloto_id' => $pilotoId
    ]);
}
    
}
