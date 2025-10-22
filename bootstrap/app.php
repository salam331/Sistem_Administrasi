<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Daftarkan alias Anda di sini
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class, // <-- TAMBAHKAN BARIS INI
    
            // (Alias bawaan lainnya mungkin sudah ada di sini)
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            // ...dan seterusnya
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
