<?php

use App\Http\Middleware\MidAdmin;
use App\Http\Middleware\MidMantenimientoCrear;
use App\Http\Middleware\MidMantenimientoListar;
use App\Http\Middleware\MidNaveListar;
use App\Http\Middleware\MidPilotoAsignar;
use App\Http\Middleware\MidPilotoDesasignar;
use App\Http\Middleware\MidPilotoListar;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/api/nologin');
        $middleware->alias([
            'midadmin' => MidAdmin::class,
            'midnavelistar' => MidNaveListar::class,
            'midpilotoasignar' => MidPilotoAsignar::class,
            'midpilotodesasignar' => MidPilotoDesasignar::class,
            'midpilotolistar' => MidPilotoListar::class,
            'midmantenimientocrear' => MidMantenimientoCrear::class,
            'midmantenimientolistar' => MidMantenimientoListar::class
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
