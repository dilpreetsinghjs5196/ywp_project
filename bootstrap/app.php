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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\App\Http\Middleware\GuestCartMiddleware::class);
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        $middleware->redirectTo(
            fn($request) => ($request->is('admin/*') || $request->is('admin')) ? route('admin.login') : route('login')
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
