<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Mantenimiento;
use App\Models\Nave;
use App\Models\Planeta;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class ModificarMantenimientoTest extends TestCase
{
    use RefreshDatabase;

   public function test_admin_modificar_un_mantenimiento(){

    //se crea un usuario con el rol de admin
    $admin = User::factory()->create(['role' => 'admin']);
    //se crea un planeta
    $planeta = Planeta::factory()->create();
    //se crea una nava y se le pase el id del planeta
    $nave = Nave::factory()->create(['planeta_id' => $planeta->id]);

    //se crea un mantenimiento para modificar
    $mantenimiento = Mantenimiento::factory()->create([
        'nave_id' => $nave->id,
        'descripcion' => 'Descripcion',
        'coste' => 100
    ]);

    $datosNuevos = [
        'descripcion' => 'Descripcion nueva',
        'coste' => 200
    ];

    Sanctum::actingAs($admin,['admin']);

    $response = $this->putJson('/api/mantenimientos/'. $mantenimiento->id, $datosNuevos);
    $response->assertStatus(200);
    $response->assertJsonFragment([
            'descripcion' => 'Descripcion nueva',
            'coste' => '200.00'
        ]);
    $this->assertDatabaseHas('mantenimientos', [
            'id' => $mantenimiento->id,
            'descripcion' => 'Descripcion nueva',
            'coste' => 200.00
        ]);

        $this->assertDatabaseMissing('mantenimientos', [
            'id' => $mantenimiento->id,
            'descripcion' => 'Descripcion'
        ]);


   }
}
