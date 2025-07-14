<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Http\Middleware\TrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'UserUrlCheck'=> \App\Http\Middleware\UserUrlCheck::class,
            'ComissionUrlCheck'=> \App\Http\Middleware\ComissionUrlCheck::class,
            'PlanCheckCreateCom'=>\App\Http\Middleware\PlanCheckCreateCom::class,
            'PlanCheckCreateNote'=>\App\Http\Middleware\PlanCheckCreateNote::class,
            'PlanCheckCreateImg'=>\App\Http\Middleware\PlanCheckCreateImg::class,
            'PlanCheckUploadImg'=>\App\Http\Middleware\PlanCheckUploadImg::class,
            'VerificationCheck'=>\App\Http\Middleware\VerificationCheck::class,
            'UserPlanCheck'=>\App\Http\Middleware\UserPlanCheck::class
        ]);
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
