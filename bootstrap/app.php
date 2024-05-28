<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        //IMPORTANT - REGISTER ALL MIDDLEWARE HERE
        //add 28/5 login admin auth, mention existence of admin middleware
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,

            // test1 later add 28/5 login staff auth, mention existence of staff middleware
            'staff' => \App\Http\Middleware\Staff::class,
        ]);

        
        /*$middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
        ]); */
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
