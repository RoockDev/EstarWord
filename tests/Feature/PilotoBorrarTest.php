<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Piloto;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class PilotoBorrarTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_puede_borrar_un_piloto()
    {
        $piloto = Piloto::factory()->create();

        
         $admin = User::factory()->create(['role' => 'admin']);

         Sanctum::actingAs($admin,['admin']);
         $this->assertDatabaseHas('pilotos', ['id' => $piloto->id]);
         $response = $this->deleteJson('/api/pilotos/' . $piloto->id);
         $response->assertStatus(200);
         $response->assertJsonFragment(['message' => 'Piloto eliminado con exito']);
         $this->assertDatabaseMissing('pilotos', [
             'id' => $piloto->id
         ]);

        // $piloto = Piloto::factory()->create();
        // $admin = User::factory()->create(['role' => 'admin']);

        // // Crear token explícitamente
        // $token = $admin->createToken('test-token')->plainTextToken;
        
        // $this->assertDatabaseHas('pilotos', ['id' => $piloto->id]);
        
        // $response = $this->withHeaders([
        //     'Authorization' => 'Bearer ' . $token,
        // ])->deleteJson('/api/pilotos/' . $piloto->id);
        
        // $response->assertStatus(200);
        // $response->assertJsonFragment(['message' => 'Piloto eliminado con exito']);
        
        // $this->assertDatabaseMissing('pilotos', ['id' => $piloto->id]);

    }
}
