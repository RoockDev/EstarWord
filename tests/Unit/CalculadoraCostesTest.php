<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\Mantenimiento;
use Carbon\Carbon;

class CalculadoraCostesTest extends TestCase
{
    public function test_calcula_coste_correctamente()
    {
        $fechaInicio = '2025-01-01';
        $fechaFin = '2025-01-03';

        $costeEsperado = 300;

        $costeCalculado = Mantenimiento::calcularCostePorDias($fechaInicio,$fechaFin);

        $this->assertEquals($costeEsperado,$costeCalculado);
    }
}
