<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckLicense; // On importe le middleware de contrôle

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 1. Appliquer le Kill Switch sur TOUT le site (web)
        $middleware->append(CheckLicense::class);

        // 2. Tes alias existants
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'auth'  => \Illuminate\Auth\Middleware\Authenticate::class,
        ]);
    })     
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();